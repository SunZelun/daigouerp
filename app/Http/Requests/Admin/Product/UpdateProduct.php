<?php namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.product.edit', $this->product);
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
            'description' => ['nullable', 'string'],
            'selling_price_rmb' => ['nullable', 'numeric'],
            'selling_price_sgd' => ['nullable', 'numeric'],
            'buying_price_rmb' => ['nullable', 'numeric'],
            'buying_price_sgd' => ['nullable', 'numeric'],
            'brand_id' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'numeric'],
            'remarks' => ['nullable', 'string'],
            'status' => ['sometimes', 'integer'],
            'quantity' => ['required', 'numeric'],
        ];
    }
}
