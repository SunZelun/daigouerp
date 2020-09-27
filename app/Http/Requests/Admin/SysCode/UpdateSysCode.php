<?php namespace App\Http\Requests\Admin\SysCode;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateSysCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.sys-code.edit', $this->sysCode);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'code' => ['sometimes', 'string'],
            'type' => ['sometimes', 'string'],
            'name' => ['sometimes', 'string'],
            'status' => ['sometimes', 'boolean'],
            
        ];
    }
}
