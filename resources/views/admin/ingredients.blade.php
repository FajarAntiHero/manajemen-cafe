@extends('layouts.admin')

@section('title', 'Manajemen Cafe - Ingredients')

@section('page-name') Ingredients @endsection
@section('contents')
<div>
    <div>
        <p class="mb-4">Ingredients help you organize and group your products.</p>
        <div class="flex mb-4">
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Ingredients</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $ingredients->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div></div>
        </div>
    </div>
     <form action="{{ route('admin.ingredients.store') }}" method="post" class="w-full flex gap-2 mb-4 items-end">
        @csrf
        <div class="flex flex-col">
            <label for="" class="font-bold">Name</label>
            <input type="text" name="name" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <div class="flex flex-col">
            <label for="" class="font-bold">Stock</label>
            <input type="number" name="stock" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <div class="flex flex-col">
            <label for="" class="font-bold">Unit</label>
            <input type="text" name="unit" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <button type="submit" class="h-fit bg-primary text-white rounded-xl p-2">Submit</button>
     </form>

     @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
     @endif

     <table class="w-full">
            <thead>
                <tr class="w-full">
                    <th class="border border-primary p-2 rounded-tl-xl">No</th>
                    <th class="border border-primary p-2">Nama</th>
                    <th class="border border-primary p-2">Stock</th>
                    <th class="border border-primary p-2">Unit</th>
                    <th class="border border-primary p-2 rounded-tr-xl">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ingredients as $index => $ingredient)
                    <tr class="w-full">
                        <td class="border border-primary p-2">{{ $index + 1 }}</td>
                        <td class="border border-primary p-2">{{ $ingredient->name }}</td>
                        <td class="border border-primary p-2">{{ $ingredient->stock }}</td>
                        <td class="border border-primary p-2">{{ $ingredient->unit }}</td>
                        <td class="border border-primary p-2">
                            <a href="{{ route('admin.ingredients.edit', $ingredient) }}"><i class="fa-regular fa-pen-to-square text-primary"></i></a>
                            <form action="{{ route('admin.ingredients.destroy', $ingredient) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="hover:cursor-pointer">
                                    <i class="fa-regular fa-trash-can text-primary"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
</div>
@endsection