<div class="form-group row align-items-center" :class="{'has-danger': errors.has('category_id'), 'has-success': this.fields.category_id && this.fields.category_id.valid }">
    <label for="category_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Category') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.category" placeholder="Category Name" :custom-label="nameOnly" :options="{{ json_encode($categories) }}" @input="updateSelectedCategory" open-direction="bottom" label="name" track-by="name"></multiselect>
        <div v-if="errors.has('category_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('category_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('brand_id'), 'has-success': this.fields.brand_id && this.fields.brand_id.valid }">
    <label for="brand_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Brand') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.brand" placeholder="Brand Name" :custom-label="nameOnly" :options="{{ json_encode($brands) }}" @input="updateSelectedBrand" open-direction="bottom" label="name" track-by="name"></multiselect>
        <div v-if="errors.has('brand_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('brand_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.product.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea v-model="form.description" v-validate="''" @input="validate($event)" class="hidden-xs-up" id="description" name="description"></textarea>
            <quill-editor v-model="form.description" :options="wysiwygConfig" />
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('Quantity') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.quantity" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('Quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="sales" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('已卖出') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <p class="form-control" style="border: none !important;">@{{ form.sales }}</p>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('selling_price_rmb'), 'has-success': this.fields.selling_price_rmb && this.fields.selling_price_rmb.valid }">
    <label for="selling_price_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.selling_price_rmb') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.selling_price_rmb" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('selling_price_rmb'), 'form-control-success': this.fields.selling_price_rmb && this.fields.selling_price_rmb.valid}" id="selling_price_rmb" name="selling_price_rmb" placeholder="{{ trans('admin.product.columns.selling_price_rmb') }}">
        <div v-if="errors.has('selling_price_rmb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('selling_price_rmb') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('selling_price_sgd'), 'has-success': this.fields.selling_price_sgd && this.fields.selling_price_sgd.valid }">
    <label for="selling_price_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.selling_price_sgd') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.selling_price_sgd" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('selling_price_sgd'), 'form-control-success': this.fields.selling_price_sgd && this.fields.selling_price_sgd.valid}" id="selling_price_sgd" name="selling_price_sgd" placeholder="{{ trans('admin.product.columns.selling_price_sgd') }}">
        <div v-if="errors.has('selling_price_sgd')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('selling_price_sgd') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('buying_price_rmb'), 'has-success': this.fields.buying_price_rmb && this.fields.buying_price_rmb.valid }">
    <label for="buying_price_rmb" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.buying_price_rmb') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.buying_price_rmb" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('buying_price_rmb'), 'form-control-success': this.fields.buying_price_rmb && this.fields.buying_price_rmb.valid}" id="buying_price_rmb" name="buying_price_rmb" placeholder="{{ trans('admin.product.columns.buying_price_rmb') }}">
        <div v-if="errors.has('buying_price_rmb')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('buying_price_rmb') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('buying_price_sgd'), 'has-success': this.fields.buying_price_sgd && this.fields.buying_price_sgd.valid }">
    <label for="buying_price_sgd" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.buying_price_sgd') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.buying_price_sgd" v-validate="'decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('buying_price_sgd'), 'form-control-success': this.fields.buying_price_sgd && this.fields.buying_price_sgd.valid}" id="buying_price_sgd" name="buying_price_sgd" placeholder="{{ trans('admin.product.columns.buying_price_sgd') }}">
        <div v-if="errors.has('buying_price_sgd')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('buying_price_sgd') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('remarks'), 'has-success': this.fields.remarks && this.fields.remarks.valid }">
    <label for="remarks" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product.columns.remarks') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <textarea v-model="form.remarks" v-validate="''" @input="validate($event)" class="hidden-xs-up" id="remarks" name="remarks"></textarea>
            <quill-editor v-model="form.remarks" :options="wysiwygConfig" />
        </div>
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


