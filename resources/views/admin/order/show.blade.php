@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Detail'))

@section('body')

    <div class="container-xl">

        <div class="card">
                <div class="card-header">
                    <i class="fa fa-pencil"></i> Order Detail
                </div>

                <div class="card-block">
                    <div class="form-group row align-items-center">
                        <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Customer Name</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $order->customer->name }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="customer_address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Customer Address</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $order->address->address.' '.$order->address->contact_person.' '.$order->address->contact_number }}
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">Remarks</label>
                        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                            {{ $order->remarks }}
                        </div>
                    </div>

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

                    <div>
                        <div class="summary-board col-md-6">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>Total Cost in SGD</td>
                                    <td>{{ $order->cost_in_sgd }}</td>
                                    <td>Total Cost in RMB</td>
                                    <td>{{ $order->cost_in_rmb }}</td>
                                </tr>
                                <tr>
                                    <td>Total Selling Price (SGD)</td>
                                    <td>{{ $order->revenue_in_sgd }}</td>
                                    <td>Total Selling Price (RMB)</td>
                                    <td>{{ $order->revenue_in_rmb }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Total Profit (SGD)</b></td>
                                    <td>{{ $order->profit_in_sgd }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><b>Total Profit (RMB)</b></td>
                                    <td>{{ $order->profit_in_rmb }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
        </div>
    </div>
@endsection