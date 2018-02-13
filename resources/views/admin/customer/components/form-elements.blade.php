<div class="card">
    <div class="card-header">
        <i class="fa fa-plus"></i> {{ trans('Customer Profile') }}
    </div>

    <div class="card-block">
        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
            <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer.columns.name') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.customer.columns.name') }}">
                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
            </div>
        </div>

        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('wechat_name'), 'has-success': this.fields.wechat_name && this.fields.wechat_name.valid }">
            <label for="wechat_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer.columns.wechat_name') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.wechat_name" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('wechat_name'), 'form-control-success': this.fields.wechat_name && this.fields.wechat_name.valid}" id="wechat_name" name="wechat_name" placeholder="{{ trans('admin.customer.columns.wechat_name') }}">
                <div v-if="errors.has('wechat_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('wechat_name') }}</div>
            </div>
        </div>

        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
            <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.customer.columns.remarks') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.customer.columns.remarks') }}">
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
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="icon-wallet"></i> Addresses
    </div>

    <div class="card-block">
        <div v-for="(address, index) in form.addresses">
            <div class="col-sm-12 row">
                <div class="col-sm-12 col-md-12">
                    <label for="address" class="col-form-label text-md-right">{{ trans('admin.customer-address.columns.address') }}</label>
                    <input type="text" v-model="address.address" v-validate="'required'" @input="validate($event)" class="form-control" id="address" name="address" placeholder="{{ trans('admin.customer-address.columns.address') }}">
                </div>

                <div class="col-md-3">
                    <label for="contact_person" class="col-form-label text-md-right">{{ trans('admin.customer-address.columns.contact_person') }}</label>
                    <input type="text" v-model="address.contact_person" v-validate="''" @input="validate($event)" class="form-control" id="contact_person" name="contact_person" placeholder="{{ trans('admin.customer-address.columns.contact_person') }}">
                </div>

                <div class="col-md-3">
                    <label for="contact_number" class="col-form-label text-md-right">{{ trans('admin.customer-address.columns.contact_number') }}</label>
                    <input type="text" v-model="address.contact_number" v-validate="''" @input="validate($event)" class="form-control" id="contact_number" name="contact_number" placeholder="{{ trans('admin.customer-address.columns.contact_number') }}">
                </div>

                <div class="col-md-3">
                    <label for="remarks" class="col-form-label text-md-right">{{ trans('admin.customer-address.columns.remarks') }}</label>
                    <input type="text" v-model="address.remarks" v-validate="''" @input="validate($event)" class="form-control" id="remarks" name="remarks" placeholder="{{ trans('admin.customer-address.columns.remarks') }}">
                </div>

                <div class="col-md-2">
                    <label class="col-form-label text-md-right">Status</label>
                    <br>
                    <input class="form-check-input" :id="index" type="checkbox" v-model="address.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
                    <label class="form-check-label" :for="index">
                        {{ trans('Active') }}
                    </label>
                    <input type="hidden" name="status" :value="address.status">
                    <a class="btn btn-sm btn-danger" title="Delete" @click="delRow(index)"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <div class="col-sm-12 hrline">
                <hr>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="card-block">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <a @click="addRow" href="#" class="btn btn-sm btn-primary"><i class="icon-plus"></i> Address</a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <br>
</div>