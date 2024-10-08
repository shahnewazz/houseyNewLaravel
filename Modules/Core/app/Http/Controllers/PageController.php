<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use App\Http\Controllers\Controller;
use Modules\Core\Http\Requests\Page\PageStoreRequest;
use Modules\Core\Http\Requests\Page\PageUpdateRequest;

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

        if (empty($request->slug) && Page::checkHomePage()) {
            return back()->with('error', 'Home page already exists.');
            
        }

        if(empty($request->slug)){
            $slug = '';
            $request->merge(['slug' => $slug, 'is_home' => 1]);
        }

    
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->widgets = $request->widgets;
        $page->status = $request->status;
        $page->is_home = $request->is_home ?? 0;
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
        $page = Page::findOrFail($id);
        return view('core::pages.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateRequest $request, $id)
    {

        $page = Page::findOrFail($id);

        if(!$page->is_home && empty($request->slug)){
            return back()->with('error', 'Home page slug already exists.');
        }
        
        if($page->is_home){

            if(!empty($request->slug)){
                return back()->with('error', 'Home page slug cannot be updated.');
            }

            if($request->status == 'inactive'|| $request->status == 'darft'){
                return back()->with('error', 'Home page status cannot be inactive or draft.');
            }
        }

        if(empty($request->slug)){
            $request->merge(['slug' => null, 'is_home' => 1]);
        }
        
        $page->title    = $request->title;
        $page->slug     = (empty($request->slug) && $page->is_home) ? null : $request->slug;
        $page->widgets  = $request->widgets;
        $page->status   = $request->status;
        $page->is_home  = (empty($request->slug) && $page->is_home) ? 1 : 0;
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // check if page is home page
        $page = Page::findOrFail($id);
        if($page->is_home){
            return redirect()->route('admin.pages.index')->with('error', 'Home page cannot be deleted.');
        }
        if(Page::findOrFail($id)->delete()){
            return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
        }
    }

    /**
     * Set page as home page
     */

    public function setHomePage($id)
    {

        Page::query()->update(['is_home' => 0]);

        $page = Page::findOrFail($id);
        $page->is_home = 1;
        $page->save();
    
        $pages = Page::all();
        $html = view('core::pages.page.partials._page-list', compact('pages'))->render();
        
        return response()->json(['html' => $html]);
    }


    /**
     * Edit page widgets
     */

    public function widgetEdit($page_id){
        $page = Page::findOrFail($page_id);
        return view('core::pages.page.widgets', compact('page'));
    }
}
