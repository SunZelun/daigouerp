<?php namespace App\Http\Requests\Admin\SysCode;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreSysCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.sys-code.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'code' => ['required', 'string'],
            'type' => ['required', 'string'],
            'name' => ['required', 'string'],
            'status' => ['required', 'integer'],
            
        ];
    }
}
