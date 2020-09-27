@if (!empty($latestOrders) && count($latestOrders) > 0)
    @foreach($latestOrders as $inOrder)
        <tr class="order">
            <td><a href="/admin/orders/{{ $inOrder->id }}" target="_blank">{{ $inOrder->id }}</a></td>
            <td>{{ $inOrder->customer->name }} ({{ $inOrder->customer->wechat_name }})</td>
            <td>{{ date('Y-m-d', strtotime($inOrder->order_date)) }}</td>
            <td>{{ $inOrder->updated_at }}</td>
            <td>
                <span class="badge {{ $inOrder->status_color }}">{{ $inOrder->order_status_text }}</span>
            </td>
            <td>
                <div class="col-auto">
                    <a class="btn btn-sm btn-spinner btn-info" target="_blank" href="/admin/orders/{{ $inOrder->id }}/edit" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
@endif