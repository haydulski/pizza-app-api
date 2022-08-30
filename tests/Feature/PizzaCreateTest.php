<?php

use App\Models\Pizza;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(Illuminate\Foundation\Testing\WithFaker::class);

test('create new pizza', function ($name) {
    Storage::fake('avatars');
    $file = UploadedFile::fake()->image('avatars.jpg');

    $response = logged()->post('/api/pizza', [
        'name' => $name,
        'dough' => 'thick',
        'price' => 124,
        'img' => $file

    ]);

    $response->assertStatus(200);
    $this->assertIsInt($response->json());

    expect(Pizza::latest()->first())->price->toBeFloat();
})->with('pizzanames');
