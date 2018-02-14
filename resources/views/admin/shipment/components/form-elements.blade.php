<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ship_date'), 'has-success': this.fields.ship_date && this.fields.ship_date.valid }">
    <label for="ship_date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.ship_date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.ship_date" :config="datetimePickerConfig" v-validate="'required|date_format:YYYY-MM-DD HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('ship_date'), 'form-control-success': this.fields.ship_date && this.fields.ship_date.valid}" id="ship_date" name="ship_date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('ship_date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ship_date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.type" v-validate="'required|numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('type'), 'form-control-success': this.fields.type && this.fields.type.valid}" id="type" name="type" placeholder="{{ trans('admin.shipment.columns.type') }}">
        <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('logistic_company_name'), 'has-success': this.fields.logistic_company_name && this.fields.logistic_company_name.valid }">
    <label for="logistic_company_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.logistic_company_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.logistic_company_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('logistic_company_name'), 'form-control-success': this.fields.logistic_company_name && this.fields.logistic_company_name.valid}" id="logistic_company_name" name="logistic_company_name" placeholder="{{ trans('admin.shipment.columns.logistic_company_name') }}">
        <div v-if="errors.has('logistic_company_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('logistic_company_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tracking_number'), 'has-success': this.fields.tracking_number && this.fields.tracking_number.valid }">
    <label for="tracking_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.tracking_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.tracking_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tracking_number'), 'form-control-success': this.fields.tracking_number && this.fields.tracking_number.valid}" id="tracking_number" name="tracking_number" placeholder="{{ trans('admin.shipment.columns.tracking_number') }}">
        <div v-if="errors.has('tracking_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tracking_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('logistic_status'), 'has-success': this.fields.logistic_status && this.fields.logistic_status.valid }">
    <label for="logistic_status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.logistic_status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.logistic_status" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('logistic_status'), 'form-control-success': this.fields.logistic_status && this.fields.logistic_status.valid}" id="logistic_status" name="logistic_status" placeholder="{{ trans('admin.shipment.columns.logistic_status') }}">
        <div v-if="errors.has('logistic_status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('logistic_status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_currency'), 'has-success': this.fields.cost_currency && this.fields.cost_currency.valid }">
    <label for="cost_currency" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.cost_currency') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost_currency" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost_currency'), 'form-control-success': this.fields.cost_currency && this.fields.cost_currency.valid}" id="cost_currency" name="cost_currency" placeholder="{{ trans('admin.shipment.columns.cost_currency') }}">
        <div v-if="errors.has('cost_currency')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost_currency') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost'), 'has-success': this.fields.cost && this.fields.cost.valid }">
    <label for="cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cost" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost'), 'form-control-success': this.fields.cost && this.fields.cost.valid}" id="cost" name="cost" placeholder="{{ trans('admin.shipment.columns.cost') }}">
        <div v-if="errors.has('cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.remarks') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.shipment.columns.remarks') }}">
        <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipment_status'), 'has-success': this.fields.shipment_status && this.fields.shipment_status.valid }">
    <label for="shipment_status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.shipment_status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipment_status" v-validate="'required|numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipment_status'), 'form-control-success': this.fields.shipment_status && this.fields.shipment_status.valid}" id="shipment_status" name="shipment_status" placeholder="{{ trans('admin.shipment.columns.shipment_status') }}">
        <div v-if="errors.has('shipment_status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipment_status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <label for="status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.shipment.columns.status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.status" v-validate="'required|numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('status'), 'form-control-success': this.fields.status && this.fields.status.valid}" id="status" name="status" placeholder="{{ trans('admin.shipment.columns.status') }}">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


