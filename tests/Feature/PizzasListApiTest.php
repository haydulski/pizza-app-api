<?php

use App\Models\Pizza;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('pizza api list', function () {
    Pizza::factory(5)->create();

    $response = $this->get('/api/pizza');

    $response->assertStatus(200);
    expect($response->json())->toBeArray();
})->group('api');
