<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email,'.$this->id,
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'contact_number' => 'required|string',
            'role_id' => 'required|integer',
        ];
    }
}
