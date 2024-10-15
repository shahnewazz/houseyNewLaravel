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

        Page::create($request->validated());

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
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

        $page->update($request->validated());

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

    public function setHomePage(Request $request)
    {

       $request->validate([
            'home_page' => ['required', 'integer', 'exists:pages,id']
        ], [
            'home_page.exists' => 'Page not found.',
            'home_page.required' => 'Page ID is required.',
            'home_page.integer' => 'Page ID must be an integer.'
        ]);

        $id = $request->home_page;
        Page::where('is_home', 1)->update(['is_home' => 0]);

        $page = Page::findOrFail($id);
        $page->is_home = 1;
        $page->save();
    
        return redirect()->route('admin.pages.index')->with('success', 'Home page updated successfully.');
    }


    /**
     * Edit page widgets
     */

    public function widgetEdit($page_id){
        $page = Page::findOrFail($page_id);
        return view('core::pages.page.widgets', compact('page'));
    }

    /**
     * Load widget
     */
    public function loadWidget($widget){

        $id = request('id');

        $viewPath = "core::pages.widgets.{$widget}"; // Assuming your widgets are in the 'resources/views/widgets/' directory

        // Check if the view exists before rendering
        if (view()->exists($viewPath)) {
            return response()->json(['html' => view($viewPath, compact('id'))->render(), 'widget' => $widget]);
        }

        // If view does not exist, return a 404 or custom error
        return response()->json(['error' => 'Widget not found'], 404);
    }

    public function saveWidgets(Request $request, $id){
        
        dd($request->all());
        
        $page = Page::findOrFail($id);
        $page->widgets = $request->widgets;
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Widgets updated successfully.');
    }
}
