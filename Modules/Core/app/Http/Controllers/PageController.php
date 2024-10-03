<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use App\Http\Controllers\Controller;
use Modules\Core\Http\Requests\Page\PageStoreRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all();
        return view('core::pages.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::pages.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request)
    {
        if (empty($request->slug)) {
            $slug = 'home';
            $request->merge(['slug' => $slug, 'is_home' => true]);
        }

        if ($request->is_home && Page::checkHomePage()) {
            return back()->withErrors(['is_home' => 'There can only be one home page.']);
        }
        
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->widgets = $request->widgets;
        $page->status = $request->status;
        $page->is_home = $request->is_home;
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
