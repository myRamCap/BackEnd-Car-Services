<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
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
            'corporate_id' => 'required_without:service_center_id|integer|nullable',
            'service_center_id' => 'required_without:corporate_id|integer|nullable',
            'datefrom' => 'required|string',
            'dateto' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'image_url' => 'required|string'
        ];
    }

 
}
