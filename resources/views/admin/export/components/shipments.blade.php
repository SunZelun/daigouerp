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
        <th>发货日期</th>
        <th>顾客/产品</th>
        <th>运费</th>
        <th>运单状态</th>
        <th>备注</th>
        <th>运输公司/单号</th>
    </tr>
    <tbody>
    @if(!empty($shipments))
        @foreach($shipments as $key => $shipment)
            <tr>
                <td>{{ $shipment['index'] }}</td>
                <td>{{ $shipment['shipment_date'] }}</td>
                <td>{!! $shipment['shipment_detail'] !!}</td>
                <td>{{ $shipment['cost'] }}</td>
                <td>{{ $shipment['shipment_status'] }}</td>
                <td>{{ $shipment['remarks'] }}</td>
                <td>{{ $shipment['logistic'] }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>

</html>