<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'total_price' => 'required|numeric|min:1',
            'user_id' => 'required|integer|exists:users,id',
            'ordered_items' => 'required|array',
            'ordered_items.*.is_custom' => 'required|integer|max:1',
            'ordered_items.*.pizza_id' => 'required|integer|exists:pizzas,id',
            'ordered_items.*.amount' => 'required|integer',
            'ordered_items.*.price' => 'required|numeric',
            'ordered_items.*.dough_size' => 'required|string',
            'ordered_items.*.double_cheese' => 'required|string',
            'ordered_items.*.dough' => 'string|max:50',
            'ordered_items.*.ingredient_1' => 'string|max:50',
            'ordered_items.*.ingredient_2' => 'string|max:50',
            'ordered_items.*.ingredient_3' => 'string|max:50',
            'ordered_items.*.ingredient_4' => 'string|max:50',
            'ordered_items.*.ingredient_5' => 'string|max:50',
            'ordered_items.*.ingredient_6' => 'string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'This user can`t be found',
            'orders.array' => 'You have to pass array format data',
            'ordered_items.*.pizza_id.exists' => 'Pizza with id :input not exist in database',
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
