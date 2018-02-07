<?php namespace App\Http\Requests\Admin\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.order.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            //'user_id' => ['required', 'integer'],
            'customer_id' => ['required', 'integer'],
            'customer_address_id' => ['nullable', 'integer'],
            'cost_currency' => ['nullable', 'string'],
            'total_cost' => ['nullable', 'numeric'],
            'amount_currency' => ['nullable', 'string'],
            'total_amount' => ['nullable', 'numeric'],
            'profit_currency' => ['nullable', 'string'],
            'total_profit' => ['nullable', 'numeric'],
            'remarks' => ['nullable', 'string'],
            'products' => ['nullable', 'array'],
            
        ];
    }
}
