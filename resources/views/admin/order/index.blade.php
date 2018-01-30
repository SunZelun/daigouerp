@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.order.actions.index'))

@section('body')

    <order-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/orders') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.order.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.order.actions.create') }}</a>
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
                                    <th is='sortable' :column="'id'">{{ trans('admin.order.columns.id') }}</th>
                                    <th is='sortable' :column="'user_id'">{{ trans('admin.order.columns.user_id') }}</th>
                                    <th is='sortable' :column="'customer_id'">{{ trans('admin.order.columns.customer_id') }}</th>
                                    <th is='sortable' :column="'customer_address_id'">{{ trans('admin.order.columns.customer_address_id') }}</th>
                                    <th is='sortable' :column="'cost_currency'">{{ trans('admin.order.columns.cost_currency') }}</th>
                                    <th is='sortable' :column="'total_cost'">{{ trans('admin.order.columns.total_cost') }}</th>
                                    <th is='sortable' :column="'amount_currency'">{{ trans('admin.order.columns.amount_currency') }}</th>
                                    <th is='sortable' :column="'total_amount'">{{ trans('admin.order.columns.total_amount') }}</th>
                                    <th is='sortable' :column="'profit_currency'">{{ trans('admin.order.columns.profit_currency') }}</th>
                                    <th is='sortable' :column="'total_profit'">{{ trans('admin.order.columns.total_profit') }}</th>
                                    <th is='sortable' :column="'remarks'">{{ trans('admin.order.columns.remarks') }}</th>
                                    <th is='sortable' :column="'status'">{{ trans('admin.order.columns.status') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.user_id }}</td>
                                    <td>@{{ item.customer_id }}</td>
                                    <td>@{{ item.customer_address_id }}</td>
                                    <td>@{{ item.cost_currency }}</td>
                                    <td>@{{ item.total_cost }}</td>
                                    <td>@{{ item.amount_currency }}</td>
                                    <td>@{{ item.total_amount }}</td>
                                    <td>@{{ item.profit_currency }}</td>
                                    <td>@{{ item.total_profit }}</td>
                                    <td>@{{ item.remarks }}</td>
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
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/orders/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.order.actions.create') }}</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </order-listing>

@endsection