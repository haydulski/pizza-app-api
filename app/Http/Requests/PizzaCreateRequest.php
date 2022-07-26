<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PizzaCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required|min:3|max:100|unique:pizzas,name',
            'slug' => 'string|min:3|max:100',
            'price' => 'required|numeric|min:1',
            'img' => 'required|image',
            'dough' => 'required|string|min:4|max:100',
            'ingredient_1' => 'string|nullable|max:200',
            'ingredient_2' => 'string|nullable|max:200',
            'ingredient_3' => 'string|nullable|max:200',
            'ingredient_4' => 'string|nullable|max:200',
            'ingredient_5' => 'string|nullable|max:200',
            'ingredient_6' => 'string|nullable|max:200',
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
