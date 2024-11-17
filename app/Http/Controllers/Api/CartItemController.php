<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['user_id' => auth()->id()]
        );

        $cartItem = $cart->items()->updateOrCreate(
            ['product_id' => $request->product_id],
            ['quantity' => $request->input('quantity')]
        );

        return response()->json(['message' => 'Товар добавлен в корзину', 'item' => $cartItem], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->cart->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Товар удален из корзины'], 200);
    }
}
