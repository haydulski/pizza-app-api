<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PizzaCreateRequest;
use App\Http\Resources\PizzasResource;
use App\Models\Pizza;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as Json;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Vinkla\Hashids\Facades\Hashids;

class PizzaController extends Controller
{
    private string $imgFolder = 'imgs/pizzas/';

    public function index(): Json|Response
    {
        $data = Pizza::get();

        return PizzasResource::collection($data);
    }

    public function show(string $id): PizzasResource
    {
        $decodeId = Hashids::decode($id);
        $stringId = strval($decodeId[0]);
        $data = Cache::remember('pizza_'.$stringId, 60 * 60 * 8, function () use ($stringId) {
            return Pizza::find($stringId);
        });

        return new PizzasResource($data);
    }

    public function store(PizzaCreateRequest $req): Response
    {
        $data = $req->validated();
        $data['img'] = $this->storeImg($data['img'], $data['name']);
        $data['thumbnail'] = $this->makeThumbnail($data['img']);
        $data['img'] = $this->imgFolder.$data['img'];

        if (! isset($data['slug'])) {
            $data['slug'] = Str::slug($data['name'], '-');
        }

        $newPizza = Pizza::create($data);

        return response()->json($newPizza->id);
    }

    private function storeImg(UploadedFile $file, string $name): string
    {
        $fileName = Str::slug(Str::lower($name), '-');
        $extension = $file->getClientOriginalExtension();
        $nameToStore = $fileName.'.'.$extension;
        $thumName = 'thumbnail-'.$nameToStore;

        Storage::putFileAs($this->imgFolder, $file, $nameToStore, 'public');
        Storage::putFileAs($this->imgFolder, $file, $thumName, 'public');

        return $nameToStore;
    }

    private function makeThumbnail(string $name): string
    {
        $path = Storage::path($this->imgFolder.'thumbnail-'.$name);
        $img = Image::make($path)->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save($path);

        return $this->imgFolder.'thumbnail-'.$name;
    }
}
