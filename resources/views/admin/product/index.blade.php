@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product.actions.index'))

@section('body')

    <product-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/products') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.product.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/products/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.product.actions.create') }}</a>
                    </div>
                    <div class="card-block" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="btn-group input-group-btn">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                        </form>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">{{ trans('admin.product.columns.id') }}</th>
                                    <th is='sortable' :column="'name'">{{ trans('admin.product.columns.name') }}</th>
                                    <th is='sortable' :column="'selling_price_rmb'">{{ trans('admin.product.columns.selling_price_rmb') }}</th>
                                    <th is='sortable' :column="'selling_price_sgd'">{{ trans('admin.product.columns.selling_price_sgd') }}</th>
                                    <th is='sortable' :column="'buying_price_rmb'">{{ trans('admin.product.columns.buying_price_rmb') }}</th>
                                    <th is='sortable' :column="'buying_price_sgd'">{{ trans('admin.product.columns.buying_price_sgd') }}</th>
                                    <th is='sortable' :column="'status'">{{ trans('admin.product.columns.status') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.selling_price_rmb }}</td>
                                    <td>@{{ item.selling_price_sgd }}</td>
                                    <td>@{{ item.buying_price_rmb }}</td>
                                    <td>@{{ item.buying_price_sgd }}</td>
                                    <td>@{{ item.status }}</td>
                                    
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

	                    <div class="no-items-found" v-if="!collection.length > 0">
		                    <i class="icon-magnifier"></i>
		                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
		                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/products/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.product.actions.create') }}</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </product-listing>

@endsection