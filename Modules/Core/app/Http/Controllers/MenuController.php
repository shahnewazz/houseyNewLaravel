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
        return view('core::pages.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'menu_title' => ['required', 'string', 'max:255'],
            'menu_data' => ['required', 'json'],
            'code' => ['nullable', 'string','max:255', 'exists:language,code'],
        ]);


        Menu::create([
            'title' => $validated['menu_title'],
            'menu_items' => json_decode($validated['menu_data'], true),
            'code' => $validated['code'] ?? 'en',
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // get code parameter from the request
        $code = $request->query('code')?? 'en';

        $menu = Menu::where('id', $id)->where('code', $code)->first();
        
        if ($menu) {
            return view('core::pages.menu.edit', compact('menu'));
        }else{
            return redirect()->route('admin.menus.index')->with('error', 'Menu not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'menu_title' => ['required', 'string', 'max:255'],
            'menu_data' => ['required', 'json'],
            'code' => ['nullable', 'string','max:255', 'exists:language,code'],
        ]);


        $menu = Menu::findOrFail($id);

        $menu->title = $validated['menu_title'];
        $menu->menu_items = json_decode($validated['menu_data'], true);
        $menu->code = $validated['code'] ?? 'en';
        $menu->save(); 

        return redirect()->route('admin.menus.index')->with('success', 'Menu Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully');
    }
}
