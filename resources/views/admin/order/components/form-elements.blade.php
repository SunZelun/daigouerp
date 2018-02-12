<div class="card">
    <div class="card-header">
        <i class="icon-wallet"></i> Customer Profile
    </div>
    <div class="card-block">
        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_id'), 'has-success': this.fields.customer_id && this.fields.customer_id.valid }">
            <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_id') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <select v-model="form.customer_id" id="customer_selection" name="customer_id" class="form-control">
                    <option>Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
                <div v-if="errors.has('customer_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_id') }}</div>
            </div>
        </div>

        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_address_id'), 'has-success': this.fields.customer_address_id && this.fields.customer_address_id.valid }">
            <label for="customer_address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Customer Address') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <select v-model="form.customer_address_id" id="address_selection" name="customer_address_id" class="form-control">
                    @if(isset($addresses) && !empty($addresses))
                        @foreach($addresses as $address)
                            <option value="{{ $address->id }}">{{ $address->address }}</option>
                        @endforeach
                    @endif
                </select>
                <div v-if="errors.has('customer_address_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_address_id') }}</div>
            </div>
        </div>

        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
            <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.remarks') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.order.columns.remarks') }}">
                <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="icon-wallet"></i> Products
    </div>

    <div class="card-block">
        <div v-for="(product, index) in form.products">
            <div class="col-sm-12 row products">
                <div class="col-md-8 col-sm-12">
                    <label class="control-label hidden-sms-up">Product Name</label>
                    <multiselect v-model="product.detail" placeholder="Product Name" :custom-label="nameOnly" :options="{{ $products->toJson() }}" open-direction="bottom" label="name" track-by="name"></multiselect>
                </div>
                <div class="col-md-2 col-sm-12">
                    <label class="control-label hidden-sms-up">Quantity</label>
                    <input v-model="product.quantity" type="number" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-md-3 col-sm-12">
                    <label class="control-label hidden-sms-up col-sm-12">Buying Price</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select v-model="product.buying_currency" class="form-control">
                                <option value="SGD">SGD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input v-model="product.buying_price" class="form-control" placeholder="Buying Price" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <label class="control-label hidden-sms-up col-sm-12">Selling Price</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" v-model="product.selling_currency">
                                <option value="SGD">SGD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input v-model="product.selling_price" class="form-control" placeholder="Selling Price" />
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <label class="control-label hidden-sms-up">Remarks</label>
                    <div class="row">
                        <div class="col-sm-8">
                            <input v-model="product.remarks" placeholder="Remarks" class="form-control" type="text" />
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-sm btn-danger" title="Delete" @click="delRow(index)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 hrline">
                <hr>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="card-block col-sm-12">
        <div class="col-md-12 col-sm-12">
            <a @click="addRow" href="#" class="btn btn-sm btn-primary">Add Product</a>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
</div>

<div class="card">
    <div class="card-header">
        <i class="icon-wallet"></i> Shipping Cost
    </div>

    <div class="card-block">
        <div class="form-group row align-items-center" >
            <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('International') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <div class="row">
                    <div class="col-sm-4">
                        <select v-model="form.inter_shipping_currency" class="form-control">
                            <option value="SGD">SGD</option>
                            <option value="RMB">RMB</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <input v-model="form.inter_shipping_cost" type="number"  class="form-control" placeholder="Shipping Fee" />
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Domestic(China)') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <div class="row">
                    <div class="col-sm-4">
                        <select v-model="form.dome_shipping_currency" class="form-control">
                            <option value="RMB">RMB</option>
                            <option value="SGD">SGD</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <input v-model="form.dome_shipping_cost" type="number" class="form-control" placeholder="Shipping Fee" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="icon-wallet"></i> Summary
    </div>

    <div class="card-block">
        <div class="col-sm-12 col-md-8 text-left">
            <table class="table">
                <tbody>
                <tr>
                    <td>Total Cost in SGD</td>
                    <td>@{{ totalCostSgd }}</td>
                </tr>
                <tr>
                    <td>Total Cost in RMB</td>
                    <td>@{{ totalCostRmb }}</td>
                </tr>
                <tr>
                    <td>Total Selling Price (SGD)</td>
                    <td>@{{ totalRevSgd }}</td>
                </tr>
                <tr>
                    <td>Total Selling Price (RMB)</td>
                    <td>@{{ totalRevRmb }}</td>
                </tr>
                <tr>
                    <td>Total RMB Profit</td>
                    <td>RMB @{{ totalProfitInRmb }}</td>
                </tr>
                <tr>
                    <td>Total SGD Profit</td>
                    <td>SGD @{{ totalProfitInSgd }}</td>
                </tr>
                <tr>
                    <td><b>Total Profit Summary</b></td>
                    <td><b>RMB @{{ calcSumProfitInRmb }} &asymp; SGD @{{ calcSumProfitInSgd }}</b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>