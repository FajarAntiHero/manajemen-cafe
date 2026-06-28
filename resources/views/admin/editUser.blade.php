@extends('layouts.admin')

@section ('title', 'McCafe - Edit User')
@section ('page-name') Edit User @endsection

@section('contents')
    <div x-data="{password: ''}">
        <div class="flex justify-between items-center mb-3">
            <h1 class="font-bold text-3xl text-primary">Edit User</h1>
            <a href="{{ route('admin.users') }}" class="text-md text-gray-400 hover:text-gray-600"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <div class="w-full bg-white border rounded-3xl px-6 py-5">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="font-bold mb-1 block">Nama Lengkap</label>
                        <input type="text" name="name" class="border border-primary rounded-xl px-3 py-2 w-full" value="{{ $user->name }}">
                    </div>
                    <div class="mb-4">
                        <label class="font-bold mb-1 block">Email</label>
                        <input type="email" name="email" class="border border-primary rounded-xl px-3 py-2 w-full" value="{{ $user->email }}">
                    </div>
                    <div class="mb-4">
                        <label class="font-bold mb-1 block">Password</label>
                        <input type="password" name="password" class="border border-primary rounded-xl px-3 py-2 w-full" value="{{ $user->password }}">
                    </div>
                    <div class="mb-4">
                        <label class="font-bold mb-1 block">Role</label>
                        <select name="role" class="border border-primary rounded-xl px-3 py-2 w-full">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="dapur" {{ $user->role === 'dapur' ? 'selected' : '' }}>Dapur</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-primary text-white rounded-xl px-4 py-2">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection