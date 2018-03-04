@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.misc.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="card">

            <misc-form
                :action="'{{ url('admin/miscs') }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-plus"></i> {{ trans('admin.misc.actions.create') }}
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