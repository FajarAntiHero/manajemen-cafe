@extends('layouts.admin')
@section('title', 'Manajemen Cafe - Dashboard')

@section('page-name') Dashboard @endsection
@section('contents')
<div>
    <div class="flex gap-4 mb-6">
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Total Orders</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->count() }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Orders Hari Ini</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $todayOrders }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
        <div class="w-[230px] bg-white border rounded-3xl px-4 py-2">
            <p class="mb-2 font-bold">Pemasukan Hari Ini</p>
            <div class="flex w-full justify-between items-center">
                <p class="text-4xl font-bold font-ancizar">{{ $orders->where('status', 'paid')->sum('total_amount') }}</p>
                <i class="fa-solid fa-folder text-primary text-2xl"></i>
            </div>
        </div>
    </div>

</div>
@endsection

