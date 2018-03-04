@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.misc.actions.edit', ['name' => $misc->id]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <misc-form
                :action="'{{ $misc->resource_url }}'"
                :data="{{ $misc->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.misc.actions.edit', ['name' => $misc->id]) }}
                    </div>

                    <div class="card-block">

                        @include('admin.misc.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </misc-form>

    </div>

</div>

@endsection