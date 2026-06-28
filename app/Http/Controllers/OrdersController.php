<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $todayOrders = Order::whereDate('created_at', today())->count();

        return view('admin.orders', compact('orders', 'todayOrders'));
    }

    public function show(Order $order)
    {
        $order = Order::with('orderItems')->findOrFail($order->id);
        
        return view('admin.detailOrder', compact('order'));
    }

    public function edit(Order $order)
    {
        $order = Order::with('orderItems')->findOrFail($order->id);
        
        return view('admin.editOrder', compact('order'));
    }

    public function getItems(Order $order)
    {
        $order = Order::with('orderItems.menu')->findOrFail($order->id);

        return response()->json([
            'data' => $order->orderItems->map(fn($item) => [
                'menu_id'    => $item->menu_id,
                'name'       => $item->menu->name,
                'unit_price' => $item->price,
                'quantity'   => $item->quantity,
                'subtotal'   => $item->subtotal,
            ])
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'items'          => 'required|json',
            'total_amount'   => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,qris',
            'order_name'     => 'nullable|string|max:255',
            'notes'          => 'nullable|string|max:255',
        ]);

        $items = json_decode($request->items, true);

        if (empty($items)) {
            return back()->withErrors(['items' => 'Minimal satu item harus ditambahkan.']);
        }

        $order->update([
            'order_name'     => $request->order_name,
            'payment_method' => $request->payment_method,
            'total_amount'   => $request->total_amount,
            'notes'          => $request->notes,
            // Pertahankan nilai lama agar tidak null
            'payment_status' => $order->payment_status,
            'order_status'   => $order->order_status,
        ]);

        // Hapus items lama, replace dengan yang baru
        $order->orderItems()->delete();

        foreach ($items as $item) {
            $order->orderItems()->create([
                'menu_id'  => $item['menu_id'],
                'quantity' => $item['quantity'],
                'price'    => $item['unit_price'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('admin.orders')->with('success', 'Order berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function create()
    {
        $lastOrder = Order::whereDate('created_at', today())
        ->orderBy('id', 'desc')
        ->first();

        $nextNumber = $lastOrder 
            ? (int) substr($lastOrder->order_number, -3) + 1 
            : 1;

        $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.createOrders', compact('orderNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items'          => 'required|json',
            'total_amount'   => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,qris',
            'order_name'     => 'nullable|string|max:255',
            'notes'          => 'nullable|string|max:255',
        ]);

        $items = json_decode($request->items, true);

        if (empty($items)) {
            return back()->withErrors(['items' => 'Minimal satu item harus ditambahkan.']);
        }

        // Generate order number
        $lastOrder = Order::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $nextNumber = $lastOrder
            ? (int) substr($lastOrder->order_number, -3) + 1
            : 1;

        $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Buat order
        $order = Order::create([
            'order_number'   => $orderNumber,
            'order_name'     => $request->order_name,
            'user_id'        => auth()->id(),
            'payment_status' => "paid",
            'order_status'   => $request->order_status,
            'payment_method' => $request->payment_method,
            'total_amount'   => $request->total_amount,
            'notes'          => $request->notes,
        ]);

        // Buat order items
        foreach ($items as $item) {
            $order->orderItems()->create([
                'menu_id'        => $item['menu_id'],
                'quantity'       => $item['quantity'],
                'price'          => $item['unit_price'],
                'subtotal'       => $item['subtotal'],
            ]);
        }

        return redirect()->route('admin.orders')->with('success', 'Order berhasil dibuat.');
    }
    
}
