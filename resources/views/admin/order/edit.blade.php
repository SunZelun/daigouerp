@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order.actions.edit', ['name' => $order->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <order-form
                :action="'{{ $order->resource_url }}'"
                :data="{{ $order->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.order.actions.edit', ['name' => $order->id]) }}
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