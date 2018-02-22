@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Detail'))

@section('body')

    <div class="container-xl">

        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i> Product Detail
                </div>

                <div class="card-block">
                    <div class="form-group row align-items-center">
                        <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Category') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->category ? $product->category->name : '-' }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="brand_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Brand') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->brand ? $product->brand->name : '-' }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.name') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->name }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.description') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->remarks }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Quantity') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->quantity }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="selling_price_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.selling_price_rmb') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->selling_price_rmb }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="selling_price_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.selling_price_sgd') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->selling_price_sgd }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="buying_price_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.buying_price_rmb') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->buying_price_rmb }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="buying_price_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.buying_price_sgd') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->buying_price_sgd }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.remarks') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->remarks }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="selling_price_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Status') }}</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $product->status == \App\Models\Product::STATUS_ACTIVE ? "Active" : "Inactive" }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="icon-wallet"></i> Price History
                </div>

                <div class="card-block">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <table class="table">
                                <col width="150">
                                <col width="130">
                                <col width="130">
                                <tr>
                                    <th width="40">日期</th>
                                    <th width="30">买价</th>
                                    <th width="30">卖价</th>
                                </tr>
                                @if (!empty($priceHistory))
                                    @foreach($priceHistory as $history)
                                        <tr>
                                            <td>
                                                @if(!empty($history['order_date']))
                                                    @foreach($history['order_date'] as $date)
                                                        {{ $date }}<br>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $history['buying_price'] }}</td>
                                            <td>{{ $history['selling_price'] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No history found.</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="icon-wallet"></i> 千手观音们
                </div>

                <div class="card-block">
                    <div class="col-sm-12 col-md-12 text-left">
                        <table class="table">
                            <tr>
                                <th>名字</th>
                                <th>订单号/日期</th>
                                <th>运单号/日期</th>
                                <th></th>
                            </tr>
                            <tbody>
                            @if(isset($product['orderproducts']) && !empty($product['orderproducts']))
                                @foreach($product['orderproducts'] as $orderproduct)
                                    <tr>
                                        <td>
                                            {{ isset($orderproduct['order']['customer']) && !empty($orderproduct['order']['customer']) ? $orderproduct['order']['customer']['name'].'-'.$orderproduct['order']['customer']['wechat_name'] : '-' }}
                                        </td>
                                        <td>
                                            @if(isset($orderproduct['order']) && !empty($orderproduct['order']))
                                                <a href="/admin/orders/{{ $orderproduct['order']['id'] }}" target="_blank">{{ $orderproduct['order']['id'].' - '.date('Y/m/d', strtotime($orderproduct['order']['order_date'])) }}</a>
                                            <br>
                                                <span>{{ isset($orderStatus[$orderproduct['order']['order_status']]) ? $orderStatus[$orderproduct['order']['order_status']] : '-' }}</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            @if(isset($orderproduct['order']['shipments']) && !empty($orderproduct['order']['shipments']))
                                                <ul>
                                                    @foreach($orderproduct['order']['shipments'] as $shipment)
                                                        <li>
                                                            <a href="/admin/shipments/{{ $orderproduct['order']['id'] }}/edit" target="_blank">{{ $shipment['id'].' - '.date('Y/m/d', strtotime($shipment['ship_date'])) }}</a>
                                                            <br>
                                                            {{ $shipment['type'] == \App\Models\Shipment::TYPE_INTER ? "国际发货" : '国内发货' }} {{ $shipment['shipment_status'] == \App\Models\Shipment::SHIPMENT_SHIPPED ? "已发货" : '已送达' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
@endsection