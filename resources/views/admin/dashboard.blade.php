@extends('layouts.admin')
@section('title', 'Manajemen Cafe - Dashboard')

@section('page-name') Dashboard @endsection
@section('contents')
<div>
    <div class="flex gap-4 mb-6">
        <div class="w-[40%] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Welcome Back!</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ Auth::user()->name }}</p>
                <i class="fa-solid fa-user text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[25%] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Pemasukan Hari Ini</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $todayOrders->where('payment_status', 'paid')->sum('total_amount') }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[15%] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Orders Hari Ini</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $countTodayOrders }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[15%] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Orders</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->count() }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        
    </div>
    <div>
        <p class="font-ancizar text-2xl mb-2 font-bold">Order Hari Ini</p>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="border border-primary p-2 rounded-tl-xl text-left">No. Order</th>
                    <th class="border border-primary p-2 text-left">Nama Pesanan</th>
                    <th class="border border-primary p-2 text-left">Tanggal</th>
                    <th class="border border-primary p-2 text-center">Metode</th>
                    <th class="border border-primary p-2 text-center">Status Order</th>
                    <th class="border border-primary p-2 text-center">Status Bayar</th>
                    <th class="border border-primary p-2 text-left">Total</th>
                    <th class="border border-primary p-2 rounded-tr-xl text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($todayOrders as $order)
                <tr class="hover:bg-gray-200 transition duration-200">
                    {{-- No. Order --}}
                    <td class="border border-primary p-2 font-mono text-sm font-bold">
                        {{ $order->order_number }}
                    </td>

                    {{-- Nama Pesanan --}}
                    <td class="border border-primary p-2 text-sm">
                        {{ $order->order_name ?? '-' }}
                    </td>

                    {{-- Tanggal --}}
                    <td class="border border-primary p-2 text-sm">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>

                    {{-- Metode Pembayaran --}}
                    <td class="border border-primary p-2 text-center">
                        @if($order->payment_method === 'cash')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-lg">
                                <i class="fa-solid fa-money-bill-wave text-xs"></i> Cash
                            </span>
                        @elseif($order->payment_method === 'qris')
                            <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-1 rounded-lg">
                                <i class="fa-solid fa-qrcode text-xs"></i> QRIS
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>

                    {{-- Status Order --}}
                    <td class="border border-primary p-2 text-center">
                        @php
                            $orderStatusConfig = [
                                'pending'   => ['bg-yellow-100 text-yellow-700', 'Pending'],
                                'ongoing'   => ['bg-blue-100 text-blue-700',     'Ongoing'],
                                'completed' => ['bg-green-100 text-green-700',   'Completed'],
                                'cancelled' => ['bg-red-100 text-red-700',       'Cancelled'],
                            ];
                            [$orderClass, $orderLabel] = $orderStatusConfig[$order->order_status]
                                ?? ['bg-gray-100 text-gray-500', $order->order_status];
                        @endphp
                        <span class="inline-block text-xs font-semibold px-2 py-1 rounded-lg {{ $orderClass }}">
                            {{ $orderLabel }}
                        </span>
                    </td>

                    {{-- Status Pembayaran --}}
                    <td class="border border-primary p-2 text-center">
                        @php
                            $paymentStatusConfig = [
                                'pending'   => ['bg-yellow-100 text-yellow-700', 'Pending'],
                                'paid'      => ['bg-green-100 text-green-700',   'Paid'],
                                'cancelled' => ['bg-red-100 text-red-700',       'Cancelled'],
                            ];
                            [$paymentClass, $paymentLabel] = $paymentStatusConfig[$order->payment_status]
                                ?? ['bg-gray-100 text-gray-500', $order->payment_status];
                        @endphp
                        <span class="inline-block text-xs font-semibold px-2 py-1 rounded-lg {{ $paymentClass }}">
                            {{ $paymentLabel }}
                        </span>
                    </td>

                    {{-- Total --}}
                    <td class="border border-primary p-2 text-sm font-semibold">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </td>

                    {{-- Aksi --}}
                    <td class="border border-primary p-2 text-center">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.orders.edit', $order) }}" title="Edit">
                                <i class="fa-regular fa-pen-to-square text-blue-600 cursor-pointer"></i>
                            </a>
                            <a href="{{ route('admin.orders.show', $order->id) }}" title="Detail">
                                <i class="fa-solid fa-eye text-primary cursor-pointer"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Hapus order {{ $order->order_number }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:cursor-pointer" title="Hapus">
                                    <i class="fa-regular fa-trash-can text-red-500"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach

            @if($todayOrders->isEmpty())
                <tr>
                    <td colspan="8" class="border border-primary p-4 text-center text-gray-400">
                        @if(request('date'))
                            Tidak ada order pada tanggal {{ \Carbon\Carbon::parse(request('date'))->format('d/m/Y') }}.
                        @else
                            Belum ada order masuk.
                        @endif
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

</div>
@endsection

