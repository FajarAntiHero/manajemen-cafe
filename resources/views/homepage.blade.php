@extends('layouts.base')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kafe | McCafe</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    <header class="bg-primary text-white p-6 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold font-ancizar">McCafe</h1>
        </div>
    </header>

    <main class="container mx-auto text-center py-20 px-4">
        <h1 class="text-5xl md:text-6xl text-primary mb-6">
            Selamat Datang di McCafe
        </h1>
        <p class="text-lg text-slate-800 mb-8 max-w-2xl mx-auto">
            Sistem terpadu untuk mengelola pesanan, stok, dan karyawan kafe Anda dengan mudah.
        </p>
        <a href="{{ route('login') }}" class="inline-block bg-primary text-white px-10 py-3 rounded-lg font-bold hover:opacity-90 transition duration-300">
            Login
        </a>
        
    </main>

</body>
</html>
@endsection