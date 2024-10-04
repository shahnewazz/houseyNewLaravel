<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Menu;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('core::pages.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_title' => ['required', 'string', 'max:255'],
        ]);

        $menu = Menu::create([
            'title' => $validated['menu_title'],
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $single_menu = Menu::findOrFail($id);
        return view('core::pages.menu.index', compact('single_menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_title' => ['required', 'string', 'max:255'],
            'menu_data' => ['required', 'json']
        ]);

        $menu = Menu::findOrFail($id)->first();
        $menu->title = $request->menu_title;
        $menu->menu_items = $request->menu_data;
        $menu->save();

        return redirect()->route('admin.menus.index')->with('Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
