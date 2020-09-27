<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        table {
            font-family:  'simhei';
            font-size:  12px;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid gainsboro;
        }
    </style>
</head>

<body>

<table class="table">
    <tr>
        <th>S/N</th>
        <th>Type</th>
        <th>Date</th>
        <th>支出(RMB)</th>
        <th>支出(SGD)</th>
        <th>收入(RMB)</th>
        <th>收入(SGD)</th>
        <th>备注</th>
    </tr>
    <tbody>
    @if(!empty($miscs))
        <?php $key = 1; ?>
        @foreach($miscs as $misc)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ isset($misc['type']['name']) ? $misc['type']['name'] : '-' }}</td>
                <td>{{ $misc['date'] }}</td>
                <td>{{ $misc['cost_in_rmb'] }}</td>
                <td>{{ $misc['cost_in_sgd'] }}</td>
                <td>{{ $misc['income_in_rmb'] }}</td>
                <td>{{ $misc['income_in_sgd'] }}</td>
                <td>{{ $misc['remarks'] }}</td>
            </tr>
            <?php $key++; ?>
        @endforeach
    @endif
    </tbody>
</table>
</body>

</html>