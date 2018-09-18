@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Dashboard'))

@section('body')

    <div class="container-xl">
        <div class="row col-md-12">
            <div class="col-sm-6 col-lg-3">
                <div class="social-box linkedin">
                    <i style="font-size: 30px;"><small>Cost</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <b>RMB {{ $summary['cost_in_rmb'] }} / SGD {{ $summary['cost_in_sgd'] }}</b><br>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="social-box google-plus">
                    <i style="font-size: 30px;"><small>Revenue</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <b>RMB {{ $summary['revenue_in_rmb'] }} / SGD {{ $summary['revenue_in_sgd'] }}</b><br>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="social-box facebook">
                    <i style="font-size: 30px;"><small>Profit</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <b>RMB {{ $summary['profit_in_rmb'] }} / SGD {{ $summary['profit_in_sgd'] }}</b><br>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="social-box facebook">
                    <i style="font-size: 30px;"><small>Profit(With Misc)</small></i>
                    <ul>
                        <li style="width: 100%; border-right: none;">
                            <b>RMB {{ $summary['rmbInHand'] }} / SGD {{ $summary['sgdInHand'] }}</b><br>
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

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="text-muted small text-uppercase font-weight-bold">Sales Trend for Past 15 Days</div>
                        <div class="chart-wrapper">
                            <canvas id="lineChart" width="100" height="50"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Latest Orders
                </div>
                <div class="card-body">
                    @if($latestOrders)
                        <table class="table table-hover table-responsive">
                            <tr>
                                <th>Order Id</th>
                                <th>顾客姓名</th>
                                <th>Order Date</th>
                                <th>最后一次修改时间</th>
                                <th>订单状态</th>
                                <th></th>
                            </tr>
                            <tbody id="latest-order-body">
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
                            <tr id="btn-row">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a id="load-more-btn" href="#" class="btn btn-outline-dark">加载更多</a>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
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
                                <?php $buyerBreakdown = array_values($buyerBreakdown); ?>
                                @if(!empty($buyerBreakdown))
                                    @foreach($buyerBreakdown as $buyerKey => $buyer)
                                        <li>
                                            @switch($buyerKey)
                                                @case(0)
                                                    <?php $className = "bg-danger" ?>
                                                    @break
                                                @case(1)
                                                    <?php $className = "bg-warning" ?>
                                                    @break
                                                @case(2)
                                                    <?php $className = "bg-success" ?>
                                                    @break
                                                @default
                                                    <?php $className = "bg-primary" ?>
                                            @endswitch
                                            <i class="{{ $className }}">{{ ++$buyerKey }}</i>
                                            <div class="desc">
                                                <div class="title">{{ $buyer['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">SGD {{ $buyer['revenue_in_sgd'] }}</div>
                                                <strong>RMB {{ $buyer['revenue_in_rmb'] }}</strong>
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

                        <div class="col-sm-6 col-lg-4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Total Orders</small>
                                        <br>
                                        <strong class="h4">{{ count($activeOrders) }}</strong>
                                        <div class="chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                                            <canvas id="sparkline-chart-2" width="99" height="29" class="chartjs-render-monitor" style="display: block; width: 99px; height: 29px;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-0">
                            <label style="color: black;">Top 5 Buyers ({{ $currentQuarterStart.' to '.$currentQuarterEnd }})</label>
                            <ul class="icons-list">
                                <?php $currentQuarterBuyerBreakDown = array_values($currentQuarterBuyerBreakDown); ?>
                                @if(!empty($currentQuarterBuyerBreakDown))
                                    @foreach($currentQuarterBuyerBreakDown as $buyerKeyTM => $buyerTM)
                                        <li>
                                            @switch($buyerKeyTM)
                                                @case(0)
                                                <?php $className = "bg-danger" ?>
                                                @break
                                                @case(1)
                                                <?php $className = "bg-warning" ?>
                                                @break
                                                @case(2)
                                                <?php $className = "bg-success" ?>
                                                @break
                                                @default
                                                <?php $className = "bg-primary" ?>
                                            @endswitch
                                            <i class="{{ $className }}">{{ ++$buyerKeyTM }}</i>
                                            <div class="desc">
                                                <div class="title">{{ $buyerTM['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">SGD {{ $buyerTM['revenue_in_sgd'] }}</div>
                                                <strong>RMB {{ $buyerTM['revenue_in_rmb'] }}</strong>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                            <hr class="mt-0">
                            <label style="color: black;">Top 5 Buyers ({{ $currentHalfYearStart.' to '.$currentHalfYearEnd }})</label>
                            <ul class="icons-list">
                                <?php $currentHalfYearBuyerBreakDown = array_values($currentHalfYearBuyerBreakDown); ?>
                                @if(!empty($currentHalfYearBuyerBreakDown))
                                    @foreach($currentHalfYearBuyerBreakDown as $buyerKeyHK => $buyerH)
                                        <li>
                                            @switch($buyerKeyHK)
                                                @case(0)
                                                <?php $className = "bg-danger" ?>
                                                @break
                                                @case(1)
                                                <?php $className = "bg-warning" ?>
                                                @break
                                                @case(2)
                                                <?php $className = "bg-success" ?>
                                                @break
                                                @default
                                                <?php $className = "bg-primary" ?>
                                            @endswitch
                                            <i class="{{ $className }}">{{ ++$buyerKeyHK }}</i>
                                            <div class="desc">
                                                <div class="title">{{ $buyerH['name'] }}</div>
                                            </div>
                                            <div class="value">
                                                <div class="small text-muted">SGD {{ $buyerH['revenue_in_sgd'] }}</div>
                                                <strong>RMB {{ $buyerH['revenue_in_rmb'] }}</strong>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js"></script>
    <script>
        $('#load-more-btn').click(function () {
            let offset = $('.order').length;

            $.ajax({
                method: "GET",
                url: "/admin/latest-orders",
                data: { offset: offset },
                success: function(response) {
                    $(response).insertBefore($('#btn-row'));
                }
            });
        });

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
            '#2c0540'
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

        dates = [];
        for (var i = 0; i < 15; i++){
            dates.push(moment().subtract(i, 'd').toDate().toDateString());
        }

        var config = {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    fill: false,
                    data: {!! json_encode($salesByDates) !!},
                    label: 'No. of Orders',
                    borderColor: "rgba(220,20,20,1)",
                    backgroundColor: "rgba(220,20,20,0.5)",
                    lineTension: 0
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: "time",
                        autoSkip: false,
                        time: {
                            unit: 'day',
                            round: 'day',
                            displayFormats: {
                                day: 'YYYY-MM-DD'
                            }
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        }

        var lineChart = document.getElementById("lineChart").getContext("2d");
        window.myLine = new Chart(lineChart, config);


    </script>
@endsection