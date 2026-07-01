@extends('layouts.base')

@php
    $navItems = [
        ['route' => 'dashboard', 'icon' => 'fa-regular fa-house group-hover:text-black', 'label' => 'Dashboard'],
        ['route' => 'admin.orders', 'icon' => 'fa-solid fa-basket-shopping group-hover:text-black', 'label' => 'Pesanan'],
        ['route' => 'admin.categories', 'icon' => 'fa-regular fa-folder group-hover:text-black', 'label' => 'Kategori'],
        ['route' => 'admin.menus', 'icon' => 'fa-solid fa-list group-hover:text-black', 'label' => 'Menu'],
        ['route' => 'admin.users', 'icon' => 'fa-regular fa-user group-hover:text-black', 'label' => 'Pengguna'],
    ];
    if (Auth::user()->role === 'kasir') {
        $navItems = [
            ['route' => 'dashboard', 'icon' => 'fa-regular fa-house group-hover:text-black', 'label' => 'Dashboard'],
            ['route' => 'admin.orders', 'icon' => 'fa-solid fa-basket-shopping group-hover:text-black', 'label' => 'Pesanan'],
        ];
    }
@endphp


@section('content')
<div class="dashboard flex h-full w-full gap-4 bg-base p-4">
    <div class="sidebar w-[300px] bg-white rounded-3xl p-4 flex flex-col justify-between">
        <div>
            <div>
                <p class="font-ancizar text-3xl text-primary font-bold">McCafe</p>
            </div>
            <div class="mt-10 flex flex-col gap-2">
                @foreach ($navItems as $item)
                    @php $isActive = request()->routeIs($item['route']) @endphp
                    <a href="{{ route($item['route']) }}">
                        <div class="flex items-center gap-2 group">
                            <div class="p-2 rounded-xl border border-primary group-hover:border-black
                                {{ $isActive ? 'bg-primary group-hover:bg-transparent' : 'bg-transparent' }}">
                                <i class="{{ $item['icon'] }} text-xl
                                    {{ $isActive ? 'text-white' : 'text-primary' }}"></i>
                            </div>
                            <p class="{{ $isActive ? 'font-semibold text-primary group-text:text-black' : 'text-gray-500' }} group-hover:text-black">
                                {{ $item['label'] }}
                            </p>
                        </div>
                    </a>
                @endforeach 
            </div>
        </div>
        <form action="{{ route('logout') }}" method="post" class="mt-16">
            @csrf
            <button type="submit" class="w-full flex justify-start items-center gap-2 p-2 rounded-full border border-primary hover:bg-red-600 hover:border-white hover:text-white cursor-pointer group text-primary"><i class="fa-solid fa-arrow-right-from-bracket text-xl group-hover:text-white text-primary"></i> Keluar</button>
        </form>
    </div>
    <div class="main w-full rounded-md flex flex-col h-full gap-4">
        <a href="{{ route('admin.users.detailUser', Auth::user()->id) }}" class="header flex justify-between items-center w-full rounded-3xl bg-white px-4 py-4">
            <h1 class="font-ancizar text-2xl font-bold">@yield('page-name')</h1>
            <div class="flex items-center gap-2">
                <p class="font-ancizar text-primary text-2xl">{{ Auth::user()->name }}</p>
                <div class="w-9 h-9 rounded-xl bg-primary text-white flex justify-center items-center">FJR</div>
            </div>
        </a>
        <div class="content h-full w-full bg-white rounded-3xl px-4 py-4 overflow-y-auto">
            @yield('contents')
        </div>
    </div>
</div>
@endsection
