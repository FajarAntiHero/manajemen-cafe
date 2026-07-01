@extends ('layouts.base')

@section('title', 'Login - McCafe')

@section('content')
<div class="w-screen h-screen flex items-center justify-center bg-primary">
    <form method="POST" action="{{ route('login') }}" class="w-[500px] bg-white p-4 pt-10 rounded-3xl">
            @csrf
            <div class="flex flex-col gap-2 items-center mb-14">
                <a href="{{ route('login') }}" class="text-4xl font-bold font-ancizar text-primary">McCafe</a>
                <p class="text-lg font-ancizar font-bold">New Day, New Caffe</p>
            </div>
            <div class="flex flex-col gap-2 relative mb-8">
                <label class="block bg-white absolute -top-3 left-6 text-sm font-semibold font-ancizar px-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-4 py-3 border border-primary rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                       placeholder="Masukkan email Anda">
                
                @error('email') 
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <div class="flex flex-col gap-2 relative mb-8">
                <label class="block bg-white absolute -top-3 left-6 text-sm font-semibold font-ancizar px-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-primary rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                       placeholder="Masukkan password Anda">
            </div>

            <button type="submit" 
                    class="w-full bg-primary text-white font-bold py-2 font-ancizar rounded-full text-xl mt-10 hover:bg-primary/80 cursor-pointer">
                Login
            </button>
            
        </form>
</div>
@endsection