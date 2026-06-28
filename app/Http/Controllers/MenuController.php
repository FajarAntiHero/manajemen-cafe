<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus')->with('menus', Menu::all())->with('categories', Category::all());
    }

    // unused function
    public function create()
    {
        return view('admin.menus.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        Menu::create($validated);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $menu = Menu::with('category')->find($menu->id);
        $categories = Category::all();
        return view('admin.editMenu', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil dihapus.');
    }
    
    public function search(Request $request)
    {
        $menus = Menu::where('name', 'like', '%' . $request->q . '%')
            ->select('id', 'name', 'price')
            ->limit(10)
            ->get();

        return response()->json($menus);
    }
}
