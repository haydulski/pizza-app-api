<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IngredientCategory;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $data = Cache::remember('ingredient_categories', 60 * 60 * 8, function () {
            return IngredientCategory::with('ingredients')->get();
        });

        return response()->json($data);
    }
}
