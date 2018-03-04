<?php namespace App\Http\Requests\Admin\Misc;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateMisc extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.misc.edit', $this->misc);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'type' => ['sometimes', 'integer'],
            'date' => ['nullable', 'date'],
            'cost_in_rmb' => ['nullable', 'numeric'],
            'cost_in_sgd' => ['nullable', 'numeric'],
            'income_in_rmb' => ['nullable', 'numeric'],
            'income_in_sgd' => ['nullable', 'numeric'],
            'remarks' => ['nullable', 'string'],
            'status' => ['sometimes', 'boolean'],
            
        ];
    }
}
