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
        <th></th>
    </tr>
    <tbody>
    @if(!empty($miscs))
        @foreach($miscs as $key => $misc)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ isset($misc['type']['name']) ? $misc['type']['name'] : '-' }}</td>
                <td>{{ $misc['date'] }}</td>
                <td>{{ $misc['cost_in_rmb'] }}</td>
                <td>{{ $misc['cost_in_sgd'] }}</td>
                <td>{{ $misc['income_in_rmb'] }}</td>
                <td>{{ $misc['income_in_sgd'] }}</td>
                <td>{{ $misc['remarks'] }}</td>
                <td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>