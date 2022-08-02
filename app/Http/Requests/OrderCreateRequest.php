<?php

namespace App\Http\Requests;

use Vinkla\Hashids\Facades\Hashids;
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
            'ordered_items' => 'required|array',
            'ordered_items.*.is_custom' => 'required|integer|max:1',
            'ordered_items.*.pizza_id' => 'string|min:3',
            'ordered_items.*.amount' => 'required|integer',
            'ordered_items.*.price' => 'required|numeric',
            'ordered_items.*.dough_size' => 'required|string',
            'ordered_items.*.double_cheese' => 'required|string',
            'ordered_items.*.dough' => 'string|max:50',
            'ordered_items.*.ingredient_1' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_2' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_3' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_4' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_5' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_6' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'orders.array' => 'You have to pass array format data',
            'ordered_items.*.pizza_id.min' => 'Pizza with id :input not exist in database',
            'ordered_items.*.is_custom.max' => 'required|integer|max:1',
            'ordered_items.*.pizza_id' => 'string|min:3',
            'ordered_items.*.amount' => 'required|integer',
            'ordered_items.*.price.numeric' => 'required|numeric',
            'ordered_items.*.dough_size.string' => 'required|string',
            'ordered_items.*.double_cheese.string' => 'required|string',
            'ordered_items.*.dough.max' => 'string|max:50',
            'ordered_items.*.ingredient_1.max' => 'nullable|string|max:50',
            'ordered_items.*.ingredient_2.max' => 'nullable|string|max:50',
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
