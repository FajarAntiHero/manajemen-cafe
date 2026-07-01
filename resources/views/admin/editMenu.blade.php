@extends ('layouts.admin')

@section ('title') Manajemen Cafe - Menu @endsection

@section('page-name') Edit Menu @endsection
@section('contents')
    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $menu->name) }}" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <input 
                type="text" 
                id="description" 
                name="description" 
                value="{{ old('description', $menu->description) }}" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            @error('description')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select 
                name="category_id" 
                id="category_id" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $menu->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                value="{{ old('price', $menu->price) }}" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            @error('price')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex gap-4">
            <a href="{{ route('admin.menus') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-primary text-white py-2 px-4 rounded-md font-medium hover:bg-primary-dark transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>


@endsection