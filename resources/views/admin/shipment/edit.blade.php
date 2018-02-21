@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('Edit Shipment ', ['name' => $shipment->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <shipment-form
                :action="'{{ $shipment->resource_url }}'"
                :data="{{ $shipment->toJson() }}"
                :oorders="{{ $overseaOrders }}"
                :dorders="{{ $domeOrders }}"
                :options="{{ $shipment->type == \App\Models\Shipment::TYPE_INTER ? $overseaOrders : $domeOrders }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('Edit Shipment ', ['name' => $shipment->id]) }}
                    </div>

                    <div class="card-block">

                        @include('admin.shipment.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </shipment-form>

    </div>

</div>

@endsection