@extends('layouts.admin')

@section('title', 'Manajemen Cafe - Users')

@section('page-name') Users @endsection
@section('contents')
<div>
    <div>
        <p class="mb-4">User help you organize and group your products.</p>
        <div class="flex justify-between mb-4">
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Users</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $users->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Cashier</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $users->where('role', 'kasir')->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Admin</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $users->where('role', 'admin')->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
            <div class="w-[250px] bg-white border rounded-3xl px-4 py-2">
                <p class="mb-2 font-bold">Total Dapur</p>
                <div class="flex w-full justify-between items-center">
                    <p class="text-4xl font-bold font-ancizar">{{ $users->where('role', 'dapur')->count() }}</p>
                    <i class="fa-solid fa-folder text-primary text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
     <form action="{{ route('admin.users') }}" method="post" class="w-full flex gap-2 mb-4 items-end">
        @csrf
        <div class="flex flex-col">
            <label for="" class="font-bold">Name</label>
            <input type="text" name="name" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <div class="flex flex-col">
            <label for="" class="font-bold">Email</label>
            <input type="email" name="email" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <div class="flex flex-col">
            <label for="" class="font-bold">Password</label>
            <input type="password" name="password" required class="border border-primary rounded-xl px-2 py-2">
        </div>
        <div class="flex flex-col">
            <label for="" class="font-bold">Role</label>
            <select name="role" id="role" class="border border-primary rounded-xl px-2 py-2">
                <option value="admin">admin</option>
                <option value="kasir">kasir</option>
                <option value="dapur">dapur</option>
            </select>
        </div>
        <button type="submit" class="h-fit bg-primary text-white rounded-xl p-2">Submit</button>
     </form>
     <table class="w-full border-collapse">
            <thead>
                <tr class="w-full">
                    <th class="border border-primary p-2 rounded-tl-xl">ID</th>
                    <th class="border border-primary p-2">Name</th>
                    <th class="border border-primary p-2">Email</th>
                    <th class="border border-primary p-2">Role</th>
                    <th class="border border-primary p-2">Created At</th>
                    <th class="border border-primary p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="w-full">
                        <td class="border border-primary p-2">{{ $user->id }}</td>
                        <td class="border border-primary p-2">{{ $user->name }}</td>
                        <td class="border border-primary p-2">{{ $user->email }}</td>
                        <td class="border border-primary p-2">{{ $user->role }}</td>
                        <td class="border border-primary p-2">{{ $user->created_at }}</td>
                        <td class="border border-primary p-2">
                            <a href="{{ route('admin.users.edit', $user) }}"><i class="fa-regular fa-pen-to-square text-primary"></i></a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="post" style="display:inline;">
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