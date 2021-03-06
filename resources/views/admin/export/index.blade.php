@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Export'))

@section('body')

    <div class="container-xl">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Filters</h2>
                </div>
                <div class="card-block">
                    <div class="container">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <select id="type-selection" class="form-control">
                                        <option value="order" selected="selected">订单</option>
                                        <option value="misc">杂项</option>
                                        <option value="shipment">运单</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="order-status-div">
                                <label for="order-status" class="col-sm-2 col-form-label">Order Status</label>
                                <div class="col-sm-10">
                                    <select id="order-status" class="form-control">
                                        <option value="{{ \App\Models\Order::PENDING_DELIVERY }}">{{ \App\Models\Order::ORDER_STATUS_LABELS[\App\Models\Order::PENDING_DELIVERY] }}</option>
                                        <option value="{{ \App\Models\Order::INTERNATIONAL_SHIPPED }}">{{ \App\Models\Order::ORDER_STATUS_LABELS[\App\Models\Order::INTERNATIONAL_SHIPPED] }}</option>
                                        <option value="{{ \App\Models\Order::IN_WAREHOUSE }}">{{ \App\Models\Order::ORDER_STATUS_LABELS[\App\Models\Order::IN_WAREHOUSE] }}</option>
                                        <option value="{{ \App\Models\Order::DOMESTIC_SHIPPED }}">{{ \App\Models\Order::ORDER_STATUS_LABELS[\App\Models\Order::DOMESTIC_SHIPPED] }}</option>
                                        <option value="{{ \App\Models\Order::DELIVERED }}">{{ \App\Models\Order::ORDER_STATUS_LABELS[\App\Models\Order::DELIVERED] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" id="shipment-status-div" style="display: none;">
                                <label for="shipment-status" class="col-sm-2 col-form-label">Shipment Type</label>
                                <div class="col-sm-10">
                                    <select id="shipment-status" class="form-control">
                                        <option value="{{ \App\Models\Shipment::TYPE_INTER }}">{{ \App\Models\Shipment::TYPE_LABELS[\App\Models\Shipment::TYPE_INTER] }}</option>
                                        <option value="{{ \App\Models\Shipment::TYPE_DOME }}">{{ \App\Models\Shipment::TYPE_LABELS[\App\Models\Shipment::TYPE_DOME] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a id="search-btn" href="javascript:;" class="btn btn-primary">Search</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <br>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Results</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="javascript:;" id="export-to-csv" class="btn btn-sm btn-primary pull-right">Excel</a>
                            <a href="javascript:;" id="export-to-pdf" class="btn btn-sm btn-warning pull-right">PDF</a>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <div class="container" id="result-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script type="text/javascript">
        $('#search-btn').click(function () {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/export",
                type: 'post',
                data: {
                    type: $('#type-selection').val(),
                    order_status: $('#order-status').val(),
                    shipment_type: $('#shipment-status').val()
                },
                success: function( result ) {
                    $('#result-content').empty();
                    $('#result-content').append(result);
                }
            })
        });

        $('#export-to-csv').click(function () {
            window.open('/admin/export/csv?'+'type='+$('#type-selection').val()+'&order_status='+$('#order-status').val()+'&shipment_type='+$('#shipment-status').val(), '_blank');
            return false;
        });

        $('#export-to-pdf').click(function () {
            window.open('/admin/export/csv?'+'type='+$('#type-selection').val()+'&order_status='+$('#order-status').val()+'&shipment_type='+$('#shipment-status').val()+'&export_type=pdf', '_blank');
            return false;
        });

        $('#type-selection').change(function () {
            if ($(this).val() == "order"){
                $('#order-status-div').show();
                $('#shipment-status-div').hide();
            } else if ($(this).val() == "shipment"){
                $('#order-status-div').hide();
                $('#shipment-status-div').show();
            } else {
                $('#order-status-div').hide();
                $('#shipment-status-div').hide();
            }
        });
    </script>
@endsection