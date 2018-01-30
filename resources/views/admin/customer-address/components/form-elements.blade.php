<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_id'), 'has-success': this.fields.customer_id && this.fields.customer_id.valid }">
    <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Customer Name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select v-model="form.customer_id" v-validate="'required|numeric'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_id'), 'form-control-success': this.fields.customer_id && this.fields.customer_id.valid}" id="customer_id" name="customer_id">
                @foreach($customers as $key => $customer)
                    <option value="{{ $customer['id'] }}">{{ $customer['name'] }}</option>
                @endforeach
            </select>
        <div v-if="errors.has('customer_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address'), 'has-success': this.fields.address && this.fields.address.valid }">
    <label for="address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer-address.columns.address') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address'), 'form-control-success': this.fields.address && this.fields.address.valid}" id="address" name="address" placeholder="{{ trans('admin.customer-address.columns.address') }}">
        <div v-if="errors.has('address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('contact_person'), 'has-success': this.fields.contact_person && this.fields.contact_person.valid }">
    <label for="contact_person" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer-address.columns.contact_person') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.contact_person" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('contact_person'), 'form-control-success': this.fields.contact_person && this.fields.contact_person.valid}" id="contact_person" name="contact_person" placeholder="{{ trans('admin.customer-address.columns.contact_person') }}">
        <div v-if="errors.has('contact_person')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('contact_person') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('contact_number'), 'has-success': this.fields.contact_number && this.fields.contact_number.valid }">
    <label for="contact_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer-address.columns.contact_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.contact_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('contact_number'), 'form-control-success': this.fields.contact_number && this.fields.contact_number.valid}" id="contact_number" name="contact_number" placeholder="{{ trans('admin.customer-address.columns.contact_number') }}">
        <div v-if="errors.has('contact_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('contact_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer-address.columns.remarks') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.customer-address.columns.remarks') }}">
        <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('Active') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>