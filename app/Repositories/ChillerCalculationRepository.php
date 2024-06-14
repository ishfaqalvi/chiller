<?php

namespace App\Repositories;
use App\Models\Chiller;
use App\Models\Project;
use Illuminate\Support\Collection;
use App\Interface\ChillerCalculationInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ChillerCalculationRepository implements ChillerCalculationInterface
{
    public function calculation($projectId)
    {
        // Fetch project and related details
        $project = Project::with('details')->find($projectId);

        // Extract project load parameters
        $minLoad = $project->building_minimum_load;
        $maxLoad = $project->building_maximum_load;
        $loadIncrement = $project->load_increment;

        // Generate all possible combinations of chiller IDs
        $chillerCombinations = $this->generatePowerSet($project->details()->pluck('chiller_id')->toArray());

        $loadResults = [];
        for ($currentLoad = $minLoad; $currentLoad <= $maxLoad; $currentLoad += $loadIncrement) {
            $electricLoadResults = [];
            foreach ($chillerCombinations as $chillerCombination) {
                // Calculate electric load for each combination of chillers
                $electricLoad = $this->calculateElectricLoad($currentLoad, $chillerCombination);
                $electricLoadResults[] = [
                    'chillers' => $chillerCombination,
                    'electric_load' => $electricLoad
                ];
            }
            // Determine the optimal load steps
            $optimalLoadSteps = $this->determineLoadSteps($electricLoadResults, $project->details()->count());
            $loadResults[] = [
                'load' => $currentLoad,
                'electric_load' => $electricLoadResults,
                'load_steps' => $optimalLoadSteps
            ];
        }

        // Calculate the frequency of each chiller configuration across load steps
        $chillerFrequency = $this->calculateChillerFrequency($loadResults);

        // Identify the most frequently used chiller configurations
        $frequentChillers = $this->findMostFrequentChillers($chillerFrequency);

        // Generate the final results
        $finalResults = $this->generateResults($project->details()->pluck('chiller_id'), $frequentChillers);
        $chillerDetails = [];
        foreach ($project->details as $detail) {
            $chillerDetails[] = [
                'make_model'   => $detail->chiller->model->name,
                'max_capacity' => $detail->chiller_maximum_capacity,
                'min_capacity' => $detail->chiller_minimum_capacity,
                'water_flow'   => $detail->chilled_water_flow,
                'iplv_25'      => $detail->partial_load_25,
                'iplv_50'      => $detail->partial_load_50,
                'iplv_75'      => $detail->partial_load_75,
                'iplv_100'     => $detail->partial_load_100,
            ];
        }

        // Prepare the final data structure to return
        $finalData = [
            'project_number'    => $project->project_number,
            'project_date'      => $project->created_at,
            'project_customer'  => $project->customer->first_name . ' ' . $project->customer->last_name,
            'building_min_load' => $project->building_minimum_load,
            'building_max_load' => $project->building_maximum_load,
            'water_differential'=> $project->chilled_water_differential,
            'chillers'          => $chillerDetails,
            'results'           => $finalResults
        ];

        return $finalData;
    }

    public function generateResults($chillerIds, $results)
    {
        $chillerNames = Chiller::whereIn('id', $chillerIds)->pluck('name', 'id');
        // Create headers
        $headerRow = ['Load Steps'];
        foreach ($chillerIds as $chillerId) {
            $headerRow[] = $chillerNames[$chillerId] ?? "Chiller {$chillerId}";
        }

        // Generate result rows
        $resultRows = [];
        foreach ($results as $step => $chillers) {
            $row = [$step];
            foreach ($chillerIds as $chillerId) {
                $row[] = in_array($chillerId, explode(',', $chillers)) ? 'On' : 'Off';
            }
            $resultRows[] = $row;
        }

        return ['header' => $headerRow, 'rows' => $resultRows];
    }

    // Calculate frequency of chiller configurations
    public function calculateChillerFrequency($loadData)
    {
        $chillerFrequency = [];

        foreach ($loadData as $dataEntry) {
            foreach ($dataEntry['load_steps'] as $step => $stepDetails) {
                if (isset($stepDetails['chillers']) && count($stepDetails['chillers']) > 0) {
                    $chillerList = implode(',', $stepDetails['chillers']);
                    if (!isset($chillerFrequency[$step])) {
                        $chillerFrequency[$step] = [];
                    }
                    if (!isset($chillerFrequency[$step][$chillerList])) {
                        $chillerFrequency[$step][$chillerList] = 0;
                    }
                    $chillerFrequency[$step][$chillerList]++;
                }
            }
        }

        return $chillerFrequency;
    }

    // Find the most frequently used chiller configuration for each step
    public function findMostFrequentChillers($chillerFrequency): array
    {
        $frequentChillers = [];

        foreach ($chillerFrequency as $step => $chillerList) {
            $mostFrequent = array_keys($chillerList, max($chillerList));
            $frequentChillers[$step] = $mostFrequent[0];
        }

        return $frequentChillers;
    }

    // Determine the optimal load steps based on electric loads
    public function determineLoadSteps($electricLoadResults, $totalSteps)
    {
        $loadSteps = array_fill(1, $totalSteps, null);
        $groupedBySteps = [];

        foreach ($electricLoadResults as $result) {
            $chillerCount = count($result['chillers']);
            for ($step = 1; $step <= $totalSteps; $step++) {
                if ($chillerCount <= $step) {
                    if (!isset($groupedBySteps[$step])) {
                        $groupedBySteps[$step] = [];
                    }
                    $groupedBySteps[$step][] = $result;
                }
            }
        }

        $minElectricLoad = null;
        $minElectricLoadKey = null;

        foreach ($groupedBySteps as $step => $group) {
            $minLoad = null;

            foreach ($group as $entry) {
                if ($entry['electric_load'] > 0 && ($minLoad === null || $entry['electric_load'] < $minLoad['electric_load'])) {
                    $minLoad = $entry;
                }
            }

            if ($minLoad !== null) {
                $loadSteps[$step] = $minLoad;

                if ($minElectricLoad === null || $minLoad['electric_load'] < $minElectricLoad) {
                    $minElectricLoad = $minLoad['electric_load'];
                    $minElectricLoadKey = $step;
                }
            }
        }

        foreach ($loadSteps as $step => &$entry) {
            if ($entry !== null) {
                $entry['status'] = ($step === $minElectricLoadKey) ? 'on' : 'off';
            }
        }
        unset($entry);

        return $loadSteps;
    }

    // Generate all possible combinations of the given array
    public function generatePowerSet($inputArray)
    {
        $powerSet = [[]];

        foreach ($inputArray as $element) {
            foreach ($powerSet as $combination) {
                $powerSet[] = array_merge([$element], $combination);
            }
        }

        $filteredPowerSet = array_filter($powerSet); // Remove empty set if not needed
        usort($filteredPowerSet, fn($a, $b) => count($a) <=> count($b));

        return $filteredPowerSet;
    }

    // Calculate the electric load for the given chiller combination
    public function calculateElectricLoad($currentLoad, $chillerCombination)
    {
        if (count($chillerCombination) == 1) {
            $chiller = Chiller::find($chillerCombination[0]);
            if ($currentLoad < $chiller->chiller_maximum_capacity) {
                $expression = str_replace('x', $currentLoad, $chiller->formula);
                $language = new ExpressionLanguage();
                return $language->evaluate($expression);
            }
            return 0;
        } else {
            $totalMaxCapacity = 0;
            $totalFlow = 0;
            $totalElectricLoad = 0;

            foreach ($chillerCombination as $chillerId) {
                $chiller = Chiller::find($chillerId);
                $totalMaxCapacity += $chiller->chiller_maximum_capacity;
                $totalFlow += $chiller->chilled_water_flow;
            }

            if ($currentLoad < $totalMaxCapacity) {
                foreach ($chillerCombination as $chillerId) {
                    $chiller = Chiller::find($chillerId);
                    $chillerLoad = ($chiller->chilled_water_flow / $totalFlow) * $currentLoad;
                    $expression = str_replace('x', $chillerLoad, $chiller->formula);
                    $language = new ExpressionLanguage();
                    $calculatedLoad = $language->evaluate($expression);
                    $electricLoad = $chillerLoad / $calculatedLoad;
                    $totalElectricLoad += $electricLoad;
                }
            }
            return $totalElectricLoad;
        }
    }
}

// class ChillerCalculationRepository implements ChillerCalculationInterface
// {
// 	public function calculation($id)
// 	{
//         $project = Project::with('details')->find($id);

//         $min = $project->building_minimum_load;
//         $max = $project->building_maximum_load;
//         $increment = $project->load_increment;

//         $powerSet = $this->powerSet($project->details()->pluck('chiller_id')->toArray());

//         $loads = [];
//         for ($load = $min; $load <= $max; $load += $increment)
//         {
//             $electricLoads = [];
//             foreach($powerSet as $powerSetChillers)
//             {
//                 $electric_load = $this->electricLoad($load, $powerSetChillers);
//                 $electricLoads[] = ['chillers' => $powerSetChillers, 'electric_load' => $electric_load];
//             }
//             $loadSteps = $this->getLoadSteps($electricLoads, $project->details()->count());
//             $loads[] = ['load' => $load, 'electric_load' => $electricLoads, 'load_steps' => $loadSteps];
//         }
//         echo "<pre>";
//         print_r($loads);
//         echo "</pre>";
//         exit;
//         // Calculate chiller frequency
//         $chillerCounts = $this->calculateChillerFrequency($loads);

//         // Find the most frequent chillers
//         $mostFrequentChillers = $this->findMostFrequentChillers($chillerCounts);

//         $results = $this->generateFinalResults($project->details()->pluck('chiller_id'),  $mostFrequentChillers);
//         $chillers = [];
//         foreach($project->details as $row)
//         {
//             $chillers[] = [
//                 'make_model'   => $row->chiller->model->name,
//                 'max_capacity' => $row->chiller_maximum_capacity,
//                 'min_capacity' => $row->chiller_minimum_capacity,
//                 'water_flow'   => $row->chilled_water_flow,
//                 'iplv_25'      => $row->partial_load_25,
//                 'iplv_50'      => $row->partial_load_50,
//                 'iplv_75'      => $row->partial_load_75,
//                 'iplv_100'     => $row->partial_load_100,
//             ];
//         }
//         $data = [
//             'project_number'    => $project->project_number,
//             'project_data'      => $project->created_at,
//             'project_customer'  => $project->customer->first_name.' '.$project->customer->last_name,
//             'building_min_load' => $project->building_minimum_load,
//             'building_max_load' => $project->building_maximum_load,
//             'water_differential'=> $project->chilled_water_differential,
//             'chillers'          => $chillers,
//             'results'           => $results
//         ];
//         return $data;
// 	}

//     public function generateFinalResults($headers, $results)
//     {
//         $chillerNames  = Chiller::whereIn('id', $headers)->pluck('name', 'id');
//         // Create headers
//         $headerRow = ['Load Steps'];
//         foreach ($headers as $header) {
//             $headerRow[] = $chillerNames[$header] ?? "Chiller {$header}";
//         }

//         // Initialize result rows
//         $resultRows = [];
//         foreach ($results as $step => $chillers) {
//             $row = [$step];
//             foreach ($headers as $header) {
//                 $row[] = in_array($header, explode(',',$chillers)) ? 'On' : 'Off';
//             }
//             $resultRows[] = $row;
//         }
//         return ['header' => $headerRow, 'results' => $resultRows];
//     }

//     // Function to calculate chiller frequency per load step
//     public function calculateChillerFrequency($data)
//     {
//         $chillerCounts = [];

//         foreach ($data as $entry) {
//             foreach ($entry['load_steps'] as $step => $details)
//             {
//                 if(isset($details['chillers']) && count($details['chillers']) > 0){
//                     $chillers = implode(',', $details['chillers']);
//                     if (!isset($chillerCounts[$step])) {
//                         $chillerCounts[$step] = [];
//                     }
//                     if (!isset($chillerCounts[$step][$chillers])) {
//                         $chillerCounts[$step][$chillers] = 0;
//                     }
//                     $chillerCounts[$step][$chillers]++;
//                 }
//             }
//         }
//         return $chillerCounts;
//     }

//     // Function to find the most frequent chillers
//     public function findMostFrequentChillers($chillerCounts): array
//     {
//         $mostFrequentChillers = [];

//         foreach ($chillerCounts as $step => $chillers) {
//             $mostFrequent = array_keys($chillers, max($chillers));
//             $mostFrequentChillers[$step] = $mostFrequent[0];
//         }

//         return $mostFrequentChillers;
//     }

//     public function getLoadSteps($electricLoads, $steps)
//     {
//         $output = [];

//         // Group by load steps
//         foreach ($electricLoads as $el) {
//             $chillerCount = count($el['chillers']);
//             for ($i = 1; $i <= $steps; $i++) {
//                 if ($chillerCount <= $i) {
//                     if (!isset($output[$i])) {
//                         $output[$i] = [];
//                     }
//                     $output[$i][] = $el;
//                 }
//             }
//         }

//         // Initialize final output
//         $finalOutput = array_fill(1, $steps, null);
//         $minValue = null;
//         $minKey = null;

//         foreach ($output as $key => $group) {
//             $minRecord = null;

//             // Find the minimum electric_load in the current group
//             foreach ($group as $record) {
//                 if ($record['electric_load'] > 0 && ($minRecord === null || $record['electric_load'] < $minRecord['electric_load'])) {
//                     $minRecord = $record;
//                 }
//             }

//             // Set the minimum record if found
//             if ($minRecord !== null) {
//                 $finalOutput[$key] = $minRecord;
//                 // Determine the global minimum electric_load across all groups
//                 if ($minValue === null || $minRecord['electric_load'] < $minValue) {
//                     $minValue = $minRecord['electric_load'];
//                     $minKey = $key;
//                 }
//             }
//         }

//         // Set the status for each record in the final output
//         foreach ($finalOutput as $key => &$record) {
//             if ($record !== null) {
//                 $record['status'] = ($key === $minKey) ? 'on' : 'off';
//             }
//         }
//         unset($record); // Break the reference with the last element

//         return $finalOutput;
//     }

//     public function powerSet($array)
//     {
//         $results = [[]];
//         foreach ($array as $element) {
//             foreach ($results as $combination) {
//                 $results[] = array_merge([$element], $combination);
//             }
//         }
//         // Remove the empty set if not needed
//         $results = array_filter($results);
//         // Sort the results by the size of each subset
//         usort($results, function($a, $b) {
//             return count($a) <=> count($b);
//         });
//         return $results;
//     }

//     public function electricLoad($load, $powerSetChillers)
//     {
//         if(count($powerSetChillers) == 1)
//         {
//             $chiller = Chiller::find($powerSetChillers[0]);
//             if($load < $chiller->chiller_maximum_capacity){
//                 $expression = str_replace('x', $load, $chiller->formula);
//                 $language = new ExpressionLanguage();
//                 return $language->evaluate($expression);
//             }
//             return 0;
//         }
//         else{
//             $combineMaxCapacity = 0;
//             $combineFlow = 0;
//             $combineElectricLoad = 0;
//             foreach($powerSetChillers as $chiller)
//             {
//                 $chiller = Chiller::find($chiller);
//                 $combineMaxCapacity += $chiller->chiller_maximum_capacity;
//                 $combineFlow += $chiller->chilled_water_flow;
//             }
//             if($load < $combineMaxCapacity)
//             {
//                 foreach($powerSetChillers as $chiller)
//                 {
//                     $chiller = Chiller::find($chiller);
//                     $chillerKWr = (($chiller->chilled_water_flow/$combineFlow) * $load);
//                     $expression = str_replace('x', $chillerKWr, $chiller->formula);
//                     $language = new ExpressionLanguage();
//                     $formulaCalculation = $language->evaluate($expression);
//                     $chillerEL = $chillerKWr / $formulaCalculation;
//                     $combineElectricLoad += $chillerEL;
//                 }
//             }
//             return $combineElectricLoad;
//         }
//     }
// }
