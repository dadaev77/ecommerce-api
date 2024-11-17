<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Jobs\UpdateOrderStatusJob;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Вызываем метод для получения заказов с сортировкой и фильтрацией
        $orders = $this->getOrdersQuery($request)->get();

        return OrderResource::collection($orders);
    }

    /**
     * Получить запрос заказов с сортировкой и фильтрацией.
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getOrdersQuery(Request $request)
    {
        // Начинаем с базового запроса
        $query = Order::where('user_id', auth()->id());

        // 1. Сортировка по дате создания (параметр запроса: sort_by_date)
        if ($request->has('sort_by_date')) {
            $sortOrder = $request->input('sort_by_date') === 'desc' ? 'desc' : 'asc'; // 'desc' или 'asc', по умолчанию 'asc'
            $query->orderBy('created_at', $sortOrder);
        }

        // 2. Фильтрация по статусу (параметр запроса: status)
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }


        return $query;
    }

    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        $order->update(['status' => 'paid']);

        return response()->json(['message' => 'Статус заказа обновлен на оплачен '], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $cart = Cart::with('items.product')->where('user_id', auth()->id())->firstOrFail();

        // Логика оплаты и создания заказа
        $order = Order::create([
            'user_id' => auth()->id(),
            'payment_method_id' => $request->payment_method_id,
            'total_price' => $cart->items->sum(fn($item) => $item->quantity * $item->product->price),
            'status' => 'pending',
        ]);

        UpdateOrderStatusJob::dispatch($order)->delay(now()->addMinutes(2));

        // Удаление корзины
        $cart->delete();

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with(['user', 'paymentMethod', 'items'])->find($id);

        if (!$order || $order->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Заказ не найден или доступ запрещен',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}