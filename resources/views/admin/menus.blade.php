@extends('layouts.admin')
@section('title', 'Manajemen Cafe - Menu')

@section('page-name') Menus @endsection
@section('contents')

<div>
    <div>
        <p class="mb-4">Menu helps you organize and group your products.</p>
        <div class="flex gap-4 mb-4">
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Menus</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $menus->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Menus Tersedia</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $menus->where('is_available', true)->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Menus Tidak Tersedia</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $menus->where('is_available', false)->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.menus') }}" method="post" class="w-full flex gap-2 mb-4 items-end">
        @csrf
        <div class="flex flex-col">
            <label class="font-bold">Nama</label>
            <input type="text" name="name" required class="border border-primary rounded-xl px-2 py-2" placeholder="Nama Menu">
        </div>
        <div class="flex flex-col">
            <label class="font-bold">Deskripsi</label>
            <input type="text" name="description" required class="border border-primary rounded-xl px-2 py-2" placeholder="Deskripsi Menu">
        </div>
        <div class="flex flex-col">
            <label class="font-bold">Harga</label>
            <input type="number" name="price" required class="border border-primary rounded-xl px-2 py-2" placeholder="Harga Menu">
        </div>
        <div class="flex flex-col w-[150px]">
            <label class="font-bold">Kategori</label>
            <select name="category_id" required class="border border-primary rounded-xl px-2 py-2 w-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="h-fit px-4 py-2 bg-primary hover:bg-primary/80 text-white rounded-xl cursor-pointer">Submit</button>
    </form>

    <table class="w-full">
        <thead>
            <tr class="w-full">
                <th class="border border-primary p-2 rounded-tl-xl">No</th>
                <th class="border border-primary p-2">Nama</th>
                <th class="border border-primary p-2">Deskripsi</th>
                <th class="border border-primary p-2">Harga</th>
                <th class="border border-primary p-2">Kategori</th>
                <th class="border border-primary p-2">Status</th>
                <th class="border border-primary p-2 rounded-tr-xl">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $index => $menu)
                <tr class="w-full hover:bg-gray-200 transition duration-200">
                    <td class="border border-primary p-2">{{ $index + 1 }}</td>
                    <td class="border border-primary p-2">{{ $menu->name }}</td>
                    <td class="border border-primary p-2">{{ $menu->description }}</td>
                    <td class="border border-primary p-2">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="border border-primary p-2">{{ $menu->category->name }}</td>
                    <td class="border border-primary p-2">{{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}</td>
                    <td class="border border-primary p-2">
                        <a href="{{ route('admin.menus.edit', $menu) }}"><i class="fa-regular fa-pen-to-square text-blue-600 cursor-pointer"></i></a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')"><i class="fa-regular fa-trash-can text-red-600 cursor-pointer"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection