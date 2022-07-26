<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\IngredientCreateRequest;
use App\Models\Ingredient;
use Symfony\Component\HttpFoundation\Response;

class IngredientController extends Controller
{
    public function index(): Response
    {
        $data = Ingredient::all();

        return response()->json($data);
    }

    public function store(IngredientCreateRequest $req): Response
    {
        $data = $req->validated();
        $id = Ingredient::insertGetId($data);

        return response()->json($id);
    }
}
