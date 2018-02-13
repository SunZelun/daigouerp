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
                <div class="social-box linkedin">
                    <i style="font-size: 30px;"><small>Cost</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <strong>RMB {{ $summary['total_cost_in_rmb'] }}</strong>
                            <span>&asymp; SGD {{ $summary['total_cost_in_sgd'] }}</span>
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

        <div class="row col-md-12">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-muted small text-uppercase font-weight-bold">Sales Distribution By Category</div>
                        <div class="chart-wrapper">
                            <canvas id="categoryChart" width="100" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-muted small text-uppercase font-weight-bold">Sales Distribution By Brand</div>
                        <div class="chart-wrapper">
                            <canvas id="brandChart" width="100" height="50"></canvas>
                        </div>
                    </div>
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
                                        <strong class="h4">{{ $totalNumberOfProducts }}</strong>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        var default_colors = [
            '#ff6384',
            '#ffcd56',
            '#36a2eb',
            '#4bc0c0',
            '#a34ba3',
            '#ff9440',
            '#c9cbcf',
            '#ed8a96',
            // '#da5086',
            // '#5e2087',
            // '#3c1558',
            '#F8CCAC',
            // '#742894',
            // '#e86a8c',
            // '#f2aba1',
            '#b8428b',
            // '#97358e',
            // '#4d1a6f',
            // '#2c0540'
        ];

        // function shuffle(array) {
        //     var currentIndex = array.length, temporaryValue, randomIndex;
        //
        //     // While there remain elements to shuffle...
        //     while (0 !== currentIndex) {
        //
        //         // Pick a remaining element...
        //         randomIndex = Math.floor(Math.random() * currentIndex);
        //         currentIndex -= 1;
        //
        //         // And swap it with the current element.
        //         temporaryValue = array[currentIndex];
        //         array[currentIndex] = array[randomIndex];
        //         array[randomIndex] = temporaryValue;
        //     }
        //
        //     return array;
        // }


        var randomColors = function(number) {
            if (number > 0 && number < default_colors.length){
                return default_colors.slice(0,number);
            } else {
                return null;
            }
        };

        var pieConfig = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: {!! json_encode(array_values($salesByCategories)) !!},
                    backgroundColor: randomColors({{ count($salesByCategories) }}),
                    label: 'category'
                }],
                labels: {!! json_encode(array_keys($salesByCategories)) !!}
            },
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                title: {
                    display: false,
                    text: 'Sales Category Distribution'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var barConfig = {
            type: 'horizontalBar',
            data: {
                datasets: [{
                    data: {!! json_encode(array_values($salesByBrands)) !!},
                    backgroundColor: randomColors({{ count($salesByBrands) }}),
                }],
                labels: {!! json_encode(array_keys($salesByBrands)) !!}
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: 'Brand Distribution'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        var ctx = document.getElementById("categoryChart");
        var bar = document.getElementById("brandChart");
        var categoryChart = new Chart(ctx, pieConfig);
        var barChart = new Chart(bar, barConfig);

    </script>
@endsection