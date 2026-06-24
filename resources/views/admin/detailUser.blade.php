@extends ('layouts.admin')

@section ('title', 'McCafe - Detail User')
@section ('page-name') Detail User @endsection

@section ('contents')
<div>
    <div class="flex items-center gap-2 border border-primary rounded-full p-2 mb-6">
        <div class="bg-primary w-16 h-16 rounded-full flex justify-center items-center text-white font-bold text-2xl">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div class="text-primary">
            <p class="font-bold font-ancizar text-3xl">{{ $user->name }}</p>
            <p class="text-gray-500">{{ $user->email }}</p>
        </div>
    </div>
    <p class="text-xl text-gray-500 mb-4">Informasi User</p>
    <div class="">
        <div class="w-full border border-primary rounded-xl px-4 py-3 mb-2 flex justify-between">
            <p class="font-bold text-lg">Role</p>
            <p class="text-lg">{{ $user->role }}</p>
        </div>
        <div class="w-full border border-primary rounded-xl px-4 py-3 mb-2 flex justify-between">
            <p class="font-bold text-lg">Tanggal Bergabung</p>
            <p class="text-lg">{{ $user->created_at->format('d F Y') }}</p>
        </div>
        <div class="w-full border border-primary rounded-xl px-4 py-3 mb-2 flex justify-between">
            <p class="font-bold text-lg">Terakhir Update</p>
            <p class="text-lg">{{ $user->updated_at->format('d F Y') }}</p>
        </div>
    </div>
</div>
@endsection