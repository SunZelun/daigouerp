<?php namespace App\Http\Requests\Admin\Shipment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateShipment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.shipment.edit', $this->shipment);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'ship_date' => ['sometimes', 'date'],
            'type' => ['sometimes', 'integer'],
            'logistic_company_name' => ['nullable', 'string'],
            'tracking_number' => ['nullable', 'string'],
            'logistic_status' => ['nullable', 'string'],
            'cost_currency' => ['sometimes', 'string'],
            'cost' => ['sometimes', 'numeric'],
            'remarks' => ['nullable', 'string'],
            'shipment_status' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'integer'],
            
        ];
    }
}
