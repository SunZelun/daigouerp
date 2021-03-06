@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.customer.actions.create'))

@section('body')

    <div class="container-xl">

        <div class="col-md-12 p-0">

            <customer-form
                :action="'{{ url('admin/customers') }}'"
                
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus"></i> {{ trans('admin.customer.actions.create') }}
                        </div>
                    </div>

                    @include('admin.customer.components.form-elements')

                    <button type="submit" class="btn btn-primary" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>

                </form>

            </customer-form>

        </div>

    </div>

@endsection