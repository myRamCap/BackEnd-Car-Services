<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceCenterServicesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'service_center_id' => 'required|integer',
            'service_id' => 'required|integer|unique:service_center_services,service_id',
            'estimated_time' => 'required|nullable|string',
            'estimated_time_desc' => 'nullable|string',
            'price' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'The service name field is required.',
            'service_id.unique' => 'The service name has already been taken.',
        ];
    }
}
