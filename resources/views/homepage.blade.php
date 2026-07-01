@extends('layouts.base')

@section('title', 'McCafe')

@section('content')
<div class="w-screen h-screen overflow-hidden flex justify-center items-center">
    <main class="container text-center">
        <p class="text-[42px] font-bold text-primary font-ancizar">
            McCafe
        </p>
        <p class="text-lg font-ancizar font-bold mb-8">
            New Day, New Coffe!
        </p>
        <a href="{{ route('login') }}" class="inline-block text-primary text-2xl border border-primary py-2 w-[250px] rounded-full font-bold font-ancizar hover:text-white hover:bg-primary transition duration-300">
            Login
        </a>
    </main>
</div>
@endsection