@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.product.actions.edit', ['name' => $product->name]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <product-form
                :action="'{{ $product->resource_url }}'"
                :data="{{ $product->toJson() }}"
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.product.actions.edit', ['name' => $product->name]) }}
                    </div>

                    <div class="card-block">

                        @include('admin.product.components.form-elements')

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="control-label">Price History</label>
                            </div>
                            <div class="col-md-8">
                                <table class="table">
                                    <col width="150">
                                    <col width="130">
                                    <col width="130">
                                    <tr>
                                        <th width="40">日期</th>
                                        <th width="30">买价</th>
                                        <th width="30">卖价</th>
                                    </tr>
                                    @if (!empty($priceHistory))
                                        @foreach($priceHistory as $history)
                                            <tr>
                                                <td>
                                                    @if(!empty($history['order_date']))
                                                        @foreach($history['order_date'] as $date)
                                                            {{ $date }}<br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $history['buying_price'] }}</td>
                                                <td>{{ $history['selling_price'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">No history found.</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </product-form>

    </div>

</div>

@endsection