<table class="table text-left">
    <tr>
        <th>S/N</th>
        <th>{{ '客户姓名' }}</th>
        <th>微信</th>
        <th>订单详情</th>
        <th>邮寄地址</th>
        <th></th>
    </tr>
    <tbody>
    @if(!empty($orders))
        @foreach($orders as $key => $order)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ isset($order['customer']['name']) ? $order['customer']['name'] : '-' }}</td>
                <td>{{ isset($order['customer']['wechat_name']) ? $order['customer']['wechat_name'] : '-' }}</td>
                <td>
                    @if(isset($order['products']) && !empty($order['products']))
                        @foreach($order['products'] as $product)
                            <span>{{ $product['quantity'] }} x {{ isset($product['detail']['brand']['name']) ? $product['detail']['brand']['name'].' ' : '' }} {{ isset($product['detail']['name']) ? $product['detail']['name'] : '-' }} @if(!empty($product['remarks'])) {{ '('.$product['remarks'].')' }} @endif</span>
                            <br/>
                        @endforeach
                    @endif
                </td>
                <td>
                    {{ isset($order['address']) && !empty($order['address']) ? $order['address']['contact_person'].','.$order['address']['address'].','.$order['address']['contact_number'].';'.$order['address']['remarks'] : '-' }}
                </td>
                <td></td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>