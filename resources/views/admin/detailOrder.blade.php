@extends('layouts.admin')

@section ('title', 'McCafe - Detail Order')
@section ('page-name') Detail Order @endsection

@section ('contents')
<div>
    <div class="flex gap-4 mb-8">
        <div class="w-full bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">No. Order</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $order->order_number }}</p>
                <i class="fa-regular fa-copy text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[400px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Amount</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">Rp {{ $order->total_amount }}</p>
                <i class="fa-solid fa-dollar text-primary text-2xl"></i>
            </div>
        </div>
    </div>
    <div class="flex w-full justify-between items-center mb-6">
            <p class="text-[42px] font-bold font-ancizar">{{ $order->order_name }}</p>
        <div class="flex flex-col items-end gap-3">
            @if($order->order_status === 'pending')
            <div class="flex items-center gap-1 bg-orange-100 text-orange-700 text-xl font-ancizar font-semibold px-2 py-1 rounded-lg">
                <i class="fa-solid fa-spinner text-xl"></i> Pending
            </div>
        @elseif($order->order_status === 'success')
            <div class="flex items-center gap-1 bg-green-100 text-green-700 text-xl font-ancizar font-semibold px-2 py-1 rounded-lg">
                <i class="fa-solid fa-check-circle text-xl"></i> Success
            </div>
        @elseif($order->order_status === 'cancelled')
            <div class="flex items-center gap-1 bg-red-100 text-red-700 text-xl font-ancizar font-semibold px-2 py-1 rounded-lg">
                <i class="fa-solid fa-times-circle text-xl"></i> Cancelled
            </div>
        @else
            <div class="text-gray-400 text-xl">{{ $order->order_status }}</div>
        @endif
        @if($order->payment_method === 'cash')
                <div class="flex items-center w-fit gap-1 bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-money-bill-wave text-xs"></i> Cash
                </div>
            @elseif($order->payment_method === 'qris')
                <div class="flex items-center w-fit  gap-1 bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-lg">
                    <i class="fa-solid fa-qrcode text-xs"></i> QRIS
                </div>
            @else
                <div class="text-gray-400 text-xs">-</div>
            @endif

        </div>
        
    </div>
    <table class="w-full h-fit">
        <thead>
            <tr>
                <th class="border border-primary p-2">Menu</th>
                <th class="border border-primary p-2">Quantity</th>
                <th class="border border-primary p-2">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $orderItem)
                <tr>
                    <td class="border border-primary p-2">{{ $orderItem->menu->name }}</td>
                    <td class="border border-primary p-2">{{ $orderItem->quantity }}</td>
                    <td class="border border-primary p-2">Rp {{ $orderItem->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.orders.edit', $order->id) }}" class="mt-4 inline-block bg-primary hover:bg-primary/80 text-white px-4 py-2 rounded-2xl"><i class="fa-regular fa-pen-to-square mr-2"></i>Edit</a>
</div>
@endsection