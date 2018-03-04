<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type'), 'has-success': this.fields.type && this.fields.type.valid }">
    <label for="type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select v-model="form.type" name="type" class="form-control">
                @if(isset($types) && !empty($types))
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                @endif
            </select>
            <div v-if="errors.has('type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type') }}</div>
        </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date'), 'has-success': this.fields.date && this.fields.date.valid }">
    <label for="date" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.date') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date" :config="datePickerConfig" v-validate="'date_format:YYYY-MM-DD HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('date'), 'form-control-success': this.fields.date && this.fields.date.valid}" id="date" name="date" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_in_rmb'), 'has-success': this.fields.cost_in_rmb && this.fields.cost_in_rmb.valid }">
    <label for="cost_in_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.cost_in_rmb') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.cost_in_rmb" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost_in_rmb'), 'form-control-success': this.fields.cost_in_rmb && this.fields.cost_in_rmb.valid}" id="cost_in_rmb" name="cost_in_rmb" placeholder="{{ trans('admin.misc.columns.cost_in_rmb') }}">
        <div v-if="errors.has('cost_in_rmb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost_in_rmb') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cost_in_sgd'), 'has-success': this.fields.cost_in_sgd && this.fields.cost_in_sgd.valid }">
    <label for="cost_in_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.cost_in_sgd') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.cost_in_sgd" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cost_in_sgd'), 'form-control-success': this.fields.cost_in_sgd && this.fields.cost_in_sgd.valid}" id="cost_in_sgd" name="cost_in_sgd" placeholder="{{ trans('admin.misc.columns.cost_in_sgd') }}">
        <div v-if="errors.has('cost_in_sgd')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cost_in_sgd') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('income_in_rmb'), 'has-success': this.fields.income_in_rmb && this.fields.income_in_rmb.valid }">
    <label for="income_in_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.income_in_rmb') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.income_in_rmb" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('income_in_rmb'), 'form-control-success': this.fields.income_in_rmb && this.fields.income_in_rmb.valid}" id="income_in_rmb" name="income_in_rmb" placeholder="{{ trans('admin.misc.columns.income_in_rmb') }}">
        <div v-if="errors.has('income_in_rmb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('income_in_rmb') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('income_in_sgd'), 'has-success': this.fields.income_in_sgd && this.fields.income_in_sgd.valid }">
    <label for="income_in_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.income_in_sgd') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="number" v-model="form.income_in_sgd" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('income_in_sgd'), 'form-control-success': this.fields.income_in_sgd && this.fields.income_in_sgd.valid}" id="income_in_sgd" name="income_in_sgd" placeholder="{{ trans('admin.misc.columns.income_in_sgd') }}">
        <div v-if="errors.has('income_in_sgd')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('income_in_sgd') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.misc.columns.remarks') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.remarks" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('remarks'), 'form-control-success': this.fields.remarks && this.fields.remarks.valid}" id="remarks" name="remarks" placeholder="{{ trans('admin.misc.columns.remarks') }}">
        <div v-if="errors.has('remarks')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('remarks') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.misc.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


