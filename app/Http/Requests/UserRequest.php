<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
            'house_number' => ['nullable', 'string', 'max:100'],
            'city' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255', 'unique:users'],
            'post_code' => ['nullable', 'string', 'max:200'],
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'The age field has something entered that is not an integer',
            'password.confirmed' => 'You have to confirm password',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['errors' => $validator->errors(), 'status' => true],
            422
        ));
    }
}
