<?php namespace App\Http\Requests\Admin\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCustomer extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.customer.edit', $this->customer);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'wechat_name' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'status' => ['sometimes', 'boolean'],
            
        ];
    }
}
