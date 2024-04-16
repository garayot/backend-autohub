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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->routeIs('user.login')) {
            return [
                'email'         => 'required|string|email|max:255',
                'password'      => 'required|min:8',
            ];
        } else if (request()->routeIs('user.store')) {
            return [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'     => 'required|string|email|unique:users,email|max:255',
                'password'  => 'required|min:8|confirmed',
                'role' => 'required|in:user',
            ];
        } else if (request()->routeIs('user.update')) {
            return [
                'first_name'          => 'required|string|max:255',
                'last_name'          => 'required|string|max:255',
            ];
        } else if (request()->routeIs('user.email')) {
            return [
                'email'         => 'required|string|email|max:255',
            ];
        } else if (request()->routeIs('user.password')) {
            return [
                'password'      => 'required|confirmed|min:8',
            ];
        } else if (request()->routeIs('user.image') || request()->routeIs('profile.image')) {
            return [
                'image'      => 'required|image|mimes:jpg,bmp,png|max:2048',
            ];
        } else if (request()->routeIs('profile.storeInfo')) {
            return [
                'phone' => 'nullable|digits_between:10,12',
                'address' => 'nullable|string',
                'gender' => 'nullable|in:male,female,other',
                'date_of_birth' => 'nullable|date',
                'national_ID' => 'nullable|unique:users|digits:10',
            ];
        } else if (request()->routeIs('profile.updateInfo')) {
            return [
                'role' => 'required|in:admin,user',
                'phone' => 'nullable|digits_between:10,12',
                'address' => 'nullable|string',
                'gender' => 'nullable|in:male,female,other',
                'date_of_birth' => 'nullable|date',
                'national_ID' => 'nullable|unique:users|digits:10',
            ];
        } else if (request()->routeIs('profile.show')) {
            return [
                'first_name' => 'required|string|max:255',
                'last_name'  => 'required|string|max:255',
                'email'     => 'required|string|email|unique:users,email|max:255',
                'image'      => 'required|image|mimes:jpg,bmp,png|max:2048',
                'role' => 'required|in:admin,user',
                'phone' => 'nullable|digits_between:10,12',
                'address' => 'nullable|string',
                'gender' => 'nullable|in:male,female,other',
                'date_of_birth' => 'nullable|date',
                'national_ID' => 'nullable|unique:users|digits:10',
            ];
        }
    }
}
