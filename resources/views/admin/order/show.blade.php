@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Detail'))

@section('body')

    <div class="container-xl">

        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i> Order Detail
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i> Customer Profile
                </div>

                <div class="card-block">
                    <div class="form-group row align-items-center">
                        <label for="customer_id" class="col-form-label text-md-right col-md-2">Customer Name</label>
                        <div class="col-md-9 col-xl-8">
                            {{ $order->customer->name }} - {{ $order->customer->wechat_name }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="customer_address_id" class="col-form-label text-md-right col-md-2">Customer Address</label>
                        <div class="col-md-9 col-xl-8">
                            {{ $order->address->address.' '.$order->address->contact_person.' '.$order->address->contact_number }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="order_date" class="col-form-label text-md-right col-md-2">Order Date</label>
                        <div class="col-md-9 col-xl-8">
                            {{ $order->order_date }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="status" class="col-form-label text-md-right col-md-2">Order Status</label>
                        <div class="col-md-9 col-xl-8">
                            {{ $order->order_status_name }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="remarks" class="col-form-label text-md-right col-md-2">Remarks</label>
                        <div class="col-md-9 col-xl-8">
                            {{ $order->remarks }}
                        </div>
                    </div>
                </div>
            </div>

                <div class="card">
                    <div class="card-header">
                        <i class="icon-wallet"></i> Products
                    </div>

                    <div class="card-block">
                        @if(!empty($order->products))
                            @foreach($order->products as $product)
                                <div class="col-sm-12 row products">
                                    <div class="col-md-8 col-sm-12">
                                        <label class="control-label hidden-sms-up">Product Name</label>
                                        <div>
                                            {{ $product->detail->name }}
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <label class="control-label hidden-sms-up">Quantity</label>
                                        <div>
                                            {{ $product->quantity }}
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="control-label hidden-sms-up col-sm-12">Buying Price</label>
                                        <div>
                                            {{ $product->buying_currency.' '.$product->buying_price }}
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12">
                                        <label class="control-label hidden-sms-up col-sm-12">Selling Price</label>
                                        <div>
                                            {{ $product->selling_currency.' '.$product->selling_price }}
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <label class="control-label hidden-sms-up">Remarks</label>
                                        <div>
                                            {{ $product->remarks }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 hrline">
                                    <hr>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="clearfix"></div>

                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <td><b>Total Item Sold: {{ count($order->products) }}</b></td>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <br>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="icon-wallet"></i> Summary
                    </div>

                    <div class="card-block">
                        <div class="col-sm-12 col-md-8 text-left">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Total Cost in SGD</td>
                                    <td>{{ $order->cost_in_sgd }}</td>
                                </tr>
                                <tr>
                                    <td>Total Cost in RMB</td>
                                    <td>{{ $order->cost_in_rmb }}</td>
                                </tr>
                                <tr>
                                    <td>Total Selling Price (SGD)</td>
                                    <td>{{ $order->revenue_in_sgd }}</td>
                                </tr>
                                <tr>
                                    <td>Total Selling Price (RMB)</td>
                                    <td>{{ $order->revenue_in_rmb }}</td>
                                </tr>
                                <tr>
                                    <td>Total RMB Profit</td>
                                    <td>RMB {{ $order->profit_in_rmb }}</td>
                                </tr>
                                <tr>
                                    <td>Total SGD Profit</td>
                                    <td>SGD {{ $order->profit_in_sgd }}</td>
                                </tr>
                                <tr>
                                    <td><b>Total Profit Summary</b></td>
                                    <td><b>RMB {{ $order->total_profit_in_rmb }} &asymp; SGD {{ $order->total_profit_in_sgd }}</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
        </div>
    </div>
@endsection