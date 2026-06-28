@extends ('layouts.admin')

@section('title', 'Manajemen Cafe - Category')

@section('page-name') Edit Category @endsection
@section('contents')

<div class="p-6">
    @if (session('error'))
        <div class="bg-red-200 border-2 border-red-600 p-4 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="bg-green-200 border-2 border-green-600 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $category->name) }}" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex gap-4">
            <a href="{{ route('admin.categories') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-md font-medium transition-colors">
                Batal
            </a>
            <button type="submit" class="flex-1 bg-primary text-white py-2 px-4 rounded-md font-medium hover:bg-primary-dark transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>


@endsection