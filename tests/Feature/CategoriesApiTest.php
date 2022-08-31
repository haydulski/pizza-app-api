<?php

use App\Models\Ingredient;
use App\Models\IngredientCategory;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('categories list api', function () {
    IngredientCategory::create(['category' => 'Sauce']);
    IngredientCategory::create(['category' => 'Cheese']);

    Ingredient::factory(5)->create();

    $response = $this->get('/api/ingredients/categories');

    $response->assertStatus(200);
    expect($response->json())->toBeArray();
})->group('api');
