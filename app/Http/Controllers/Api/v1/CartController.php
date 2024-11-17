<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();


        if (!$cart) {
            return response()->json([
                'success' => true,
                'message' => 'Корзина пуста',
                'cart' => [
                    'items' => [],
                    'total_price' => 0,
                ],
            ]);
        }


        $totalPrice = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

        return response()->json([
            'success' => true,
            'cart' => [
                'items' => $cart->items,
                'total_price' => $totalPrice,
            ],
        ]);
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

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Товар из корзины успешно удален',
        ]);
    }
}
