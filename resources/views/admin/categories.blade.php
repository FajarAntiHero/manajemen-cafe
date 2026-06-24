@extends('layouts.admin')
@section('title', 'Manajemen Cafe - Categories')

@section('page-name') Categories @endsection
@section('contents')

<div>
    <div>
        <p class="mb-4">Category help you organize and group your products.</p>
        <div class="flex mb-4">
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Categories</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $categories->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div></div>
        </div>
    </div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
     <form action="{{ route('admin.categories') }}" method="post" class="flex items-end gap-4 mb-6">
        @csrf
        <div class="flex flex-col">
            <label class="font-bold mb-1">Name</label>
            <input type="text" name="name" required class="border border-primary rounded-xl w-[250px] px-2 py-2" placeholder="name of category">
        </div>
        <button type="submit" class="h-fit bg-primary text-white rounded-xl p-2">Submit</button>
     </form>

     <table class="w-full">
            <thead>
                <tr>
                    <th class="border border-primary p-2 rounded-tl-xl">ID</th>
                    <th class="border border-primary p-2">Name</th>
                    <th class="border border-primary p-2">Slug</th>
                    <th class="border border-primary p-2 rounded-tr-xl">Created At</th>
                    <th class="border border-primary p-2 rounded-tr-xl">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border border-primary p-2">{{ $category->id }}</td>
                        <td class="border border-primary p-2">{{ $category->name }}</td>
                        <td class="border border-primary p-2">{{ $category->slug }}</td>
                        <td class="border border-primary p-2">{{ $category->created_at }}</td>
                        <td class="border border-primary p-2">
                            <div class="flex gap-2">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:cursor-pointer">
                                        <i class="fa-regular fa-trash-can text-primary"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.categories.edit', $category->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="hover:cursor-pointer">
                                        <i class="fa-regular fa-pen-to-square text-primary"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>    
</div>
@endsection