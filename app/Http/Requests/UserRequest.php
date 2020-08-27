<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                'name' => 'required|string|max:255',
                'username' => 'required|string|alpha_num|max:25|min:8|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:passconf',
                'foto' => 'image|mimes:png,jpg,jpeg,svg,gif|max:2048',
                'role' => 'required'

            ];
        } else {
            return [
                'name' => 'required|string|max:255',
                'username' => 'required|string|alpha_num|max:25|min:8|unique:users,username,' . $this->user->id,
                'email' => 'required|email|unique:users,email,' . $this->user->id,
                'password' => 'same:passconf',
                'foto' => 'image|mimes:png,jpg,jpeg,svg,gif|max:2048',
                'role' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib diisi!',
            'name.string' => 'Nama harus string',
            'username.required' => "Username wajib diisi",
            'username.alpha_num' => "Username hanya huruf dan angka yang diperbolehkan ",
            'username.min' => "Username minimal 8 karakter",
            'username.max' => "username maksimal 25 karakter",
            'username.unique' => "Username ini sudah digunakan",
            'email.required' => "Email wajib diisi",
            'email.email' => "Format email salah, contoh: email@email.com",
            'email.unique' => "Email ini sudah digunakan",
            'password.required' => "Password wajib diisi",
            'password.same' => "Password tidak sama",
            'foto.image' => "Yang boleh diupload hanya gambar",
            'foto.max' => "Ukuran gambar maksimal 2Mb",
            'role.required' => "Role wajib dipilih salah satu"
        ];
    }
}
