<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'nama' => ['required', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users,username,' . $this->id],
            'email' => ['required', 'email', 'unique:users,email,' . $this->id],
            'password' => ['same:password_confirmation'],
            'password_confirmation' => ['same:password'],
            'role' => ['required']
        ];
    }
}
