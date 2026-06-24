@extends ('layouts.admin')

@section ('title', 'McCafe - Orders')

@section ('page-name') Orders @endsection

@section ('contents')
<div>
    <p class="mb-4">Order helps you manage your orders.</p>
    <div class="flex gap-4 mb-6">
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Orders</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->count() }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Orders Hari Ini</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $todayOrders }}</p>
                <i class="fa-solid fa-calendar text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Payment Orders Paid</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->where('payment_status', 'paid')->count() }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Payment Orders Pending</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->where('payment_status', 'pending')->count() }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
    </div>
    <div class="flex items-center mb-4 justify-between">
        <a href="{{ route('admin.orders.create') }}"><button class="bg-primary text-white rounded-xl px-4 py-2 hover:cursor-pointer">Add Order</button></a>
        <form action="{{ route('admin.orders.search') }}" method="GET" class="flex w-fit gap-2">
            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="border border-primary rounded-xl px-2 py-2">
            <button type="submit" class="bg-primary text-white rounded-xl px-4 py-2">
                Search
            </button>
            @if(request('date'))
                <a href="{{ route('admin.orders.search') }}" class="border border-primary text-primary rounded-xl px-4 py-2">
                    Reset
                </a>
            @endif
        </form>
    </div>
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
            @foreach($orders as $order)
                <tr>
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
                                <i class="fa-regular fa-pen-to-square text-primary"></i>
                            </a>
                            <a href="{{ route('admin.orders.show', $order->id) }}" title="Detail">
                                <i class="fa-solid fa-eye text-primary"></i>
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

            @if($orders->isEmpty())
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
@endsection
