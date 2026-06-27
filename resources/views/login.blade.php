<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | McCafe</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md border-t-4 border-primary">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold font-ancizar text-primary mb-2">McCafe</h1>
            <p class="text-slate-600">Silakan login untuk masuk ke Dashboard</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                       placeholder="Masukkan email Anda">
                
                @error('email') 
                    <p class="text-red-500 text-sm mt-2 font-medium">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition duration-200"
                       placeholder="Masukkan password Anda">
            </div>

            <button type="submit" 
                    class="w-full bg-primary text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 transition duration-300 shadow-md mt-4">
                Login
            </button>
            
        </form>
    </div>

</body>
</html>