<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Project Report</h1>
    <p><strong>Project Number:</strong> {{ $project_number }}</p>
    <p><strong>Date:</strong> {{ $project_data->format('d M Y') }}</p>
    <p><strong>Client:</strong> {{ $project_customer }}</p>

    <div class="section-title">Building/Facility</div>
    <table>
        <tr>
            <th>Minimum Load (KWr)</th>
            <th>Maximum Load (KWr)</th>
            <th>Chilled Water Differential (Deg C)</th>
        </tr>
        <tr>
            <td>{{ $building_min_load }}</td>
            <td>{{ $building_max_load }}</td>
            <td>{{ $water_differential }}</td>
        </tr>
    </table>

    <div class="section-title">Chiller Particulars</div>
    @foreach ($chillers as $chiller)
        <div class="section-title">Chiller {{ $loop->iteration }}</div>
        <table>
            <tr>
                <th>Chiller Model</th>
                <td>{{ $chiller['make_model'] }}</td>
            </tr>
            <tr>
                <th>Maximum Capacity (KWr)</th>
                <td>{{ $chiller['max_capacity'] }}</td>
            </tr>
            <tr>
                <th>Minimum Capacity (KWr)</th>
                <td>{{ $chiller['min_capacity'] }}</td>
            </tr>
            <tr>
                <th>Chilled Water Flow (l/s)</th>
                <td>{{ $chiller['water_flow'] }}</td>
            </tr>
            <tr>
                <th colspan="2">Partial Load</th>
            </tr>
            <tr>
                <th>IPLV (25%)</th>
                <td>{{ $chiller['iplv_25'] }}</td>
            </tr>
            <tr>
                <th>IPLV (50%)</th>
                <td>{{ $chiller['iplv_50'] }}</td>
            </tr>
            <tr>
                <th>IPLV (75%)</th>
                <td>{{ $chiller['iplv_75'] }}</td>
            </tr>
            <tr>
                <th>IPLV (100%)</th>
                <td>{{ $chiller['iplv_100'] }}</td>
            </tr>
        </table>
    @endforeach

    <div class="section-title">Project Output</div>
    <table>
        <tr>
            <th>Chiller Load Step</th>
            <th>Upper Bound (kWr)</th>
            @foreach ($chillers as $chiller)
                <th>CH{{ $loop->iteration }}</th>
            @endforeach
        </tr>
        @foreach ($load_steps as $step)
        <tr>
            <td>{{ $step['step'] }}</td>
            <td>{{ $step['upper_bound'] }}</td>
            @foreach ($step['chillers'] as $chiller_status)
                <td>{{ $chiller_status }}</td>
            @endforeach
        </tr>
        @endforeach
    </table>
    <div class="section-title">Notes</div>
    <ol>
        <li>Lead/Lag chiller: Chiller in load step 1 / Second chiller to come online</li>
        <li>All chillers operational</li>
    </ol>
</body>
</html>
