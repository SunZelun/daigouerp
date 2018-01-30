<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_id'), 'has-success': this.fields.customer_id && this.fields.customer_id.valid }">
    <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect v-model="form.customer_id" :options="{{ $customers->toJson() }}" placeholder="Select one" label="name" track-by="name" open-direction="bottom"></multiselect>
            <div v-if="errors.has('customer_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_address_id'), 'has-success': this.fields.customer_address_id && this.fields.customer_address_id.valid }">
    <label for="customer_address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_address_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.customer_address_id" v-validate="'numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_address_id'), 'form-control-success': this.fields.customer_address_id && this.fields.customer_address_id.valid}" id="customer_address_id" name="customer_address_id" placeholder="{{ trans('admin.order.columns.customer_address_id') }}">
        <div v-if="errors.has('customer_address_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_address_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_currency'), 'has-success': this.fields.cost_currency && this.fields.cost_currency.valid }">
    <label for="cost_currency" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.cost_currency') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect v-model="form.cost_currency" :options="{{ json_encode($currencies) }}" open-direction="bottom"></multiselect>
            <div v-if="errors.has('cost_currency')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost_currency') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_cost'), 'has-success': this.fields.total_cost && this.fields.total_cost.valid }">
    <label for="total_cost" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_cost') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_cost" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_cost'), 'form-control-success': this.fields.total_cost && this.fields.total_cost.valid}" id="total_cost" name="total_cost" placeholder="{{ trans('admin.order.columns.total_cost') }}">
        <div v-if="errors.has('total_cost')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_cost') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount_currency'), 'has-success': this.fields.amount_currency && this.fields.amount_currency.valid }">
    <label for="amount_currency" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.amount_currency') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect v-model="form.amount_currency" :options="{{ json_encode($currencies) }}" open-direction="bottom"></multiselect>
            <div v-if="errors.has('amount_currency')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount_currency') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_amount'), 'has-success': this.fields.total_amount && this.fields.total_amount.valid }">
    <label for="total_amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_amount" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_amount'), 'form-control-success': this.fields.total_amount && this.fields.total_amount.valid}" id="total_amount" name="total_amount" placeholder="{{ trans('admin.order.columns.total_amount') }}">
        <div v-if="errors.has('total_amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.remarks') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.order.columns.remarks') }}">
        <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <label for="status" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.status') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.status" v-validate="'required|numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('status'), 'form-control-success': this.fields.status && this.fields.status.valid}" id="status" name="status" placeholder="{{ trans('admin.order.columns.status') }}">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


