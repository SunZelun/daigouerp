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
            'cost_in_rmb' => ['nullable', 'numeric'],
            'cost_in_sgd' => ['nullable', 'numeric'],
            'revenue_in_rmb' => ['nullable', 'numeric'],
            'revenue_in_sgd' => ['nullable', 'numeric'],
            'profit_in_rmb' => ['nullable', 'numeric'],
            'profit_in_sgd' => ['nullable', 'numeric'],
            'inter_shipping_currency' => ['nullable', 'string'],
            'inter_shipping_cost' => ['nullable', 'numeric'],
            'dome_shipping_currency' => ['nullable', 'string'],
            'dome_shipping_cost' => ['nullable', 'numeric'],
            'remarks' => ['nullable', 'string'],
            'products' => ['nullable', 'array'],
        ];
    }
}
