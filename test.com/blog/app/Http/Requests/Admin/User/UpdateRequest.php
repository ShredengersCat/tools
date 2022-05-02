<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $this->user_id,
            'role' => 'required|integer',
            'user_id' => 'required|integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'Enter the correct string.',
            'email.required' => 'The email field is required.',
            'email.string' => 'Enter the correct string.',
            'email.email' => 'Enter the correct email address.',
            'email.unique' => 'A user with this email address already exists.',
            'role.required' => 'The role field is required,',
            'role.integer' => 'Enter the number'
        ];
    }
}
