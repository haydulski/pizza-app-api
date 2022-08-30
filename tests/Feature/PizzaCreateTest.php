<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(Illuminate\Foundation\Testing\WithFaker::class);


test('create new pizza', function () {
    Storage::fake('avatars');
    $file = UploadedFile::fake()->image('avatars.jpg');

    $response = logged()->post('/api/pizza', [
        'name' => $this->faker->sentence(2, true),
        'dough' => 'thick',
        'price' => 124,
        'img' => $file

    ]);

    $response->assertStatus(200);
    $this->assertIsInt($response->json());
});
