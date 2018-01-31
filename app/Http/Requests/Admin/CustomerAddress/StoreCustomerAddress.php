<?php namespace App\Http\Requests\Admin\CustomerAddress;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCustomerAddress extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.customer-address.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'customer_id' => ['required'],
            'address' => ['required', 'string'],
            'contact_person' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            
        ];
    }
}
