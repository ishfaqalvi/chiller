<!-- resources/views/project/calculations.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Load Calculations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Load Calculations</h1>
    <div class="table-responsive">
        <table class="table table-sm table-bordered border-primary">
            <thead>
                <tr class="text-center">
                    <th rowspan="2">Load</th>
                    <th colspan="{{ count($data[1]) }}">Chillers Electric Load</th>
                    <th colspan="{{ count($project->details) }}">Load Steps</th>
                </tr>
                <tr>
                    @foreach ($data[1] as $row)
                        <th>
                            @foreach($row as $key => $id)
                                @php($chiller = chiller($id))
                                {{ $chiller->name }}</br>
                            @endforeach
                        </th>
                    @endforeach
                    @foreach ($project->details as $key => $row)
                        <th>
                            {{ ++$key }}</br>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data[0] as $row)
                    <tr>
                        <td>{{ $row['load'] }}</td>
                        @foreach($row['electric_load'] as $load)
                            <td>{{ round($load['electric_load'], 2) }}</td>
                        @endforeach
                        @foreach($row['load_steps'] as $step)
                            @if(isset($step['status']) && $step['status'] == 'on')
                                <td class="bg-success text-white" with="100%">
                                    {{ round($step['electric_load'], 2)}}</br>
                                    {{ '( '  }}
                                    @foreach($step['chillers'] as $key => $id)
                                        @if ($key != 0)
                                            {{ '|' }}
                                        @endif
                                        @php($chiller = chiller($id))
                                        {{ $chiller->name}}
                                    @endforeach
                                    {{ ')' }}
                                </td>
                            @else
                                <td></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
