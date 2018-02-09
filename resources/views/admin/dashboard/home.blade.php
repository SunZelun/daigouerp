@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Dashboard'))

@section('body')

    <div class="container-xl">
        <div class="row col-md-12">
            <div class="col-sm-6 col-lg-3">
                <div class="social-box twitter">
                    <i style="font-size: 30px;"><small>No. of Orders</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <strong>{{ count($activeOrders) }}</strong>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="social-box google-plus">
                    <i style="font-size: 30px;"><small>Revenue</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <strong>RMB {{ $summary['total_revenue_in_rmb'] }}</strong>
                            <span>&asymp; SGD {{ $summary['total_revenue_in_sgd'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="social-box facebook">
                    <i style="font-size: 30px;"><small>Profit</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <strong>RMB {{ $summary['total_profit_in_rmb'] }}</strong>
                            <span>&asymp; SGD {{ $summary['total_profit_in_sgd'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Sales
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="callout callout-info">
                                        <small class="text-muted">No. of Customers</small>
                                        <br>
                                        <strong class="h4">{{ $activeCustomers }}</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-1" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0">
                            <label style="color: black;">Top Buyers</label>
                            <ul class="icons-list">
                                @if(!empty($buyerBreakdown))
                                    @foreach($buyerBreakdown as $buyer)
                                        <li>
                                            <i class="icon-present bg-primary"></i>
                                            <div class="desc">
                                                <div class="title">{{ $buyer['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">&asymp; SGD {{ $buyer['total_revenue_in_sgd'] }}</div>
                                                <strong>RMB {{ $buyer['total_revenue_in_rmb'] }}</strong>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Products Sold</small>
                                        <br>
                                        <strong class="h4">{{ $summary['products_sold'] }}</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-2" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">No. of Products</small>
                                        <br>
                                        <strong class="h4">{{ count($activeProducts) }}</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-6" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr class="mt-0">
                            <label style="color: black;">Top Seller</label>
                            <ul class="icons-list">
                                @if(!empty($salesBreakdown))
                                    @foreach($salesBreakdown as $item)
                                        <li>
                                            <i class="icon-present bg-primary"></i>
                                            <div class="desc">
                                                <div class="title">{{ $item['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">Sold</div>
                                                <strong>{{ $item['quantity'] }}</strong>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="callout callout-warning">
                                        <small class="text-muted">Placeholder</small>
                                        <br>
                                        <strong class="h4">0</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-3" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Placeholder</small>
                                        <br>
                                        <strong class="h4">0</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-4" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <hr class="mt-0">
                            <label style="color: black;">Product Stocks</label>
                            <ul class="icons-list">
                                @if(!empty($activeProducts))
                                    @foreach($activeProducts as $product)
                                        <li>
                                            <i class="icon-present bg-primary"></i>
                                            <div class="desc">
                                                <div class="title">{{ $product['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">Stock</div>
                                                <strong>{{ $product['quantity'] }}</strong>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection