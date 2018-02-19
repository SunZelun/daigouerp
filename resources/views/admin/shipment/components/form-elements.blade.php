<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ship_date'), 'has-success': this.fields.ship_date && this.fields.ship_date.valid }">
    <label for="ship_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Shipment Date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.ship_date" :config="datePickerConfig" v-validate="'required'" class="flatpickr" :class="{'form-control-danger': errors.has('ship_date'), 'form-control-success': this.fields.ship_date && this.fields.ship_date.valid}" id="ship_date" name="ship_date" placeholder="{{ trans('Select Date') }}"></datetime>
        </div>
        <div v-if="errors.has('ship_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ship_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select :class="{'form-control-danger': errors.has('type'), 'form-control-success': this.fields.type && this.fields.type.valid}" v-model="form.type" @input="validate($event)" v-validate="'required|numeric'" name="type" class="form-control">
                @foreach($shipmentType as $typeCode => $type)
                    <option value="{{ $typeCode }}">{{ $type }}</option>
                @endforeach
            </select>
            <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('logistic_company_name'), 'has-success': this.fields.logistic_company_name && this.fields.logistic_company_name.valid }">
    <label for="logistic_company_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Logistic Company Name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.logistic_company_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('logistic_company_name'), 'form-control-success': this.fields.logistic_company_name && this.fields.logistic_company_name.valid}" id="logistic_company_name" name="logistic_company_name" placeholder="{{ trans('Logistic Company Name') }}">
        <div v-if="errors.has('logistic_company_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('logistic_company_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tracking_number'), 'has-success': this.fields.tracking_number && this.fields.tracking_number.valid }">
    <label for="tracking_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Tracking Number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.tracking_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tracking_number'), 'form-control-success': this.fields.tracking_number && this.fields.tracking_number.valid}" id="tracking_number" name="tracking_number" placeholder="{{ trans('Tracking Number') }}">
        <div v-if="errors.has('tracking_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tracking_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_currency'), 'has-success': this.fields.cost_currency && this.fields.cost_currency.valid }">
    <label for="cost_currency" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Currency') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect v-validate="'required'" :class="{'form-control-danger': errors.has('cost_currency'), 'form-control-success': this.fields.cost_currency && this.fields.cost_currency.valid}" id="cost_currency" name="cost_currency" :allow-empty="false" :show-labels="false" v-model="form.cost_currency" placeholder="Currency" :options="['SGD', 'RMB']" open-direction="bottom"></multiselect>
        <div v-if="errors.has('cost_currency')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost_currency') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': this.fields.cost && this.fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Shipping Fee') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': this.fields.cost && this.fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('Shipping Fee') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_currency'), 'has-success': this.fields.cost_currency && this.fields.cost_currency.valid }">
    <label for="orders" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Orders') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect :hide-selected="true" :close-on-select="false" :custom-label="orderDisplay" v-validate="'required'"
                     :multiple="true"
                     :class="{'form-control-danger': errors.has('orders'), 'form-control-success': this.fields.orders && this.fields.orders.valid}"
                     id="orders" name="orders"
                     v-model="form.orders"
                     :options="{{ $overseaOrders->toJson() }}"
                     :show-labels="false"
                     open-direction="bottom">
        </multiselect>
        <div v-if="errors.has('orders')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('orders') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Remarks') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('Remarks') }}">
        <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipment_status'), 'has-success': this.fields.shipment_status && this.fields.shipment_status.valid }">
    <label for="shipment_status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Shipment Status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select :class="{'form-control-danger': errors.has('shipment_status'), 'form-control-success': this.fields.shipment_status && this.fields.shipment_status.valid}" v-model="form.shipment_status" @input="validate($event)" v-validate="'required|numeric'" name="shipment_status" class="form-control">
                @foreach($shipmentStatus as $statusCode => $status)
                    <option value="{{ $statusCode }}">{{ $status }}</option>
                @endforeach
            </select>
        <div v-if="errors.has('shipment_status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipment_status') }}</div>
    </div>
</div>