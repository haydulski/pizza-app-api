<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Resources\OrderShowResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Vinkla\Hashids\Facades\Hashids;

class OrderController extends Controller
{
    public function index(): Response
    {
        if (!Gate::allows('admin-check', Auth::user())) {
            return response()->json(['errors' => 'You are not admin'], 403);
        }

        $data = Order::with('orderedItems')->get();

        return response()->json($data);
    }

    public function store(OrderCreateRequest $req): Response
    {
        $data = $req->validated();

        $newOrder = Order::create([
            'total_price' => $data['total_price'],
            'user_id' => Auth::id(),
        ]);

        foreach ($data['ordered_items'] as $item) {
            $item['pizza_id'] = Hashids::decode($item['pizza_id'])[0];
            $newOrder->orderedItems()->save(new OrderItem($item));
        }

        return response()->json(Hashids::connection('order')->encode($newOrder->id));
    }

    public function show(string $hashId): Json|Response
    {
        $id = Hashids::connection('order')->decode($hashId);

        $data = Order::where('user_id', Auth::id())->with('orderedItems')->find($id);
        if (!isset($data)) {
            return response()->json(['errors' => "Order with id $hashId are not exists"], 403);
        }

        return OrderShowResource::collection($data);
    }

    public function test()
    {
        dd(Auth::id());
    }
}
