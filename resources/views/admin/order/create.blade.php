@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <order-form
                :action="'{{ url('admin/orders') }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.order.actions.create') }}
                    </div>

                    <div class="card-block">

                        @include('admin.order.components.form-elements')

                        <div class="clearfix"></div>
                        <hr>
                        <div class="product-block">
                            <div class="col-sm-12 row hidden-sms-down product-block-header">
                                <div class="col-md-2 col-sm-12">
                                    <label class="control-label">Product Name</label>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="control-label">Quantity</label>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label class="control-label">Buying Price</label>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label class="control-label">Selling Price</label>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <label class="control-label">Remarks</label>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-sm-12">
                            <a id="add_product_btn" href="#" class="btn btn-sm btn-primary">Add Product</a>
                        </div>
                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

            </order-form>

        </div>

    </div>

@endsection

@section('bottom-scripts')
    <script>
        $('#customer_selection').change(function () {
            $.ajax({
                url: "/admin/customer-addresses/get-address-by-customer",
                type: 'get',
                data: {
                    customer_id: $(this).val()
                },
                success: function( result ) {
                    $('#address_selection').empty();
                    if (result.length > 0){
                        $.each(result, function (i,val) {
                            var option = '<option value="'+val.id+'">'+val.address+' '+val.contact_person+' '+val.contact_number+'</option>';
                            $('#address_selection').append(option);
                        })
                    }
                }
            })
        })

        $('#add_product_btn').click(function () {
            var index = $('.products').length;
            $.ajax({
                url: "/admin/orders/add-product",
                type: 'get',
                data: {
                    index: index
                },
                success: function( result ) {
                    $('.product-block').append(result);
                }
            })
        })

        $(document).on('click','.delete-product',function(){
            var parent = $(this).closest('.products');
            parent.next('.hrline').remove();
            parent.remove();
        });
    </script>
@endsection