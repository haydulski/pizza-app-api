<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserUpdateReaquest extends FormRequest
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
        return [
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore($this->route('email')),
            ],
            'name' => ['string', 'max:255'],
            'surname' => ['string', 'max:255'],
            'street' => ['string', 'max:255'],
            'house_number' => ['string', 'max:100'],
            'city' => ['nullable', 'string', 'max:255'],
            'phone' => [
                'string',
                'max:255',
                Rule::unique('users', 'phone')->ignore($this->route('phone')),
            ],
            'post_code' => ['string', 'max:200'],
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
