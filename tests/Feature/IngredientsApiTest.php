<?php

use App\Models\Ingredient;
use App\Models\IngredientCategory;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('ingredients list api', function () {
    IngredientCategory::create(['category' => 'Sauce']);
    Ingredient::factory(5)->create();

    $response = $this->get('/api/ingredients');

    $response->assertStatus(200);
    expect($response->json())->toBeArray();
})->group('api');
