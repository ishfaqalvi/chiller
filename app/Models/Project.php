<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Project
 *
 * @property $id
 * @property $customer_id
 * @property $number_of_chillers
 * @property $building_minimum_load
 * @property $building_maximum_load
 * @property $chilled_water_differential
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @property ProjectDetail[] $projectDetails
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'project_number',
        'number_of_chillers',
        'building_minimum_load',
        'building_maximum_load',
        'chilled_water_differential'
    ];

    protected $appends = ['load_delta', 'total_combined_load', 'load_increment'];
    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->project_number = 'IN-' . str_pad($model->id, 6, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    public function getLoadDeltaAttribute()
    {
        return $this->building_maximum_load - $this->building_minimum_load;
    }

    public function getTotalCombinedLoadAttribute()
    {
        $total_combined_load = 0;
        foreach($this->details as $row)
        {
            $total_combined_load += $row->chiller->chiller_maximum_capacity;
        }
        return $total_combined_load;
    }

    public function performLoadCalculations()
    {
        $min = $this->building_minimum_load;
        $max = $this->building_maximum_load;
        $increment = $this->load_increment;
        $results = [];

        // Initialize the chiller headers for the result table
        $chillerHeaders = [];
        foreach ($this->details as $index => $detail) {
            $chillerHeaders[] = 'CH' . ($index + 1);
        }

        for ($loadStep = $min, $step = 0; $loadStep <= $max; $loadStep += $increment, $step++) {
            $chillers = $this->details->pluck('chiller')->all();
            $powerSet = powerSet($chillers);
            $minLoad = null;
            $bestCombination = null;

            foreach ($powerSet as $subset) {
                if (empty($subset)) {
                    continue;
                }

                $totalLoad = array_reduce($subset, function ($carry, $chiller) use ($loadStep) {
                    return $carry + $chiller->getElectricLoad($loadStep);
                }, 0);

                if (is_null($minLoad) || $totalLoad < $minLoad) {
                    $minLoad = $totalLoad;
                    $bestCombination = $subset;
                }
            }

            $chillerStatus = array_fill(0, count($chillerHeaders), 'Off');
            if ($bestCombination) {
                foreach ($bestCombination as $chiller) {
                    $index = array_search($chiller, $chillers);
                    if ($index !== false) {
                        $chillerStatus[$index] = 'On';
                    }
                }
            }

            $results[] = [
                'Chiller Load Step' => $step,
                'Upper Bound (kWr)' => $loadStep,
                'Chillers' => $chillerStatus
            ];
        }

        return [
            'headers' => array_merge(['Chiller Load Step', 'Upper Bound (kWr)'], $chillerHeaders),
            'data' => $results
        ];
    }

    public function getLoadIncrementAttribute()
    {
        return $this->total_combined_load / 100;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Models\ProjectDetail', 'project_id', 'id');
    }
}
