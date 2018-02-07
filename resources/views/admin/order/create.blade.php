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
                        <div class="col-sm-12">
                            <a @click="addRow" href="#" class="btn btn-sm btn-primary">Add Product</a>
                        </div>
                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting" @click="pushFields">
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
                    var option = '<option value=""></option>';
                    $('#address_selection').append(option);
                    if (result.length > 0){
                        $.each(result, function (i,val) {
                            var option = '<option value="'+val.id+'">'+val.address+' '+val.contact_person+' '+val.contact_number+'</option>';
                            $('#address_selection').append(option);
                        })
                    }
                }
            })
        })
    </script>
@endsection