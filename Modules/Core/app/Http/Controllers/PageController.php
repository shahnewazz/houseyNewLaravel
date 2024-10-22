<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use App\Http\Controllers\Controller;
use Modules\Core\Models\PageTranslation;
use Modules\Core\Models\Translation;
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

    public function widgetEdit(Request $request, $page_id){
        $code = $request->query('code' , 'en');
        $page = Page::findOrFail($page_id);

        $lang_code = $code;

        return view('core::pages.page.widgets', compact('page', 'lang_code'));
    }

    /**
     * Load widget
     */
    public function loadWidget($widget){
        
        $id = request('id');
        $code = request('code');
        $viewPath = "core::pages.widgets.{$widget}";
    
        if (view()->exists($viewPath)) {
            return response()->json(['html' => view($viewPath, compact('id', 'code'))->render(), 'widget' => $widget]);
        }
    
        return response()->json(['error' => 'Widget not found'], 404);
    }

    public function saveWidgets(Request $request, $id)
    {

        // dd($request->all());
        
        $rules = [
            'widgets.*.widget_type' => 'required|string',
            'widgets.*.widget_data' => 'required|array',
            'widgets.*.widget_data.menu' => 'required|exists:menus,id',
            'widgets.*.widget_data.logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];



        if($request->hasFile("widgets.*.widget_data.account.icon.icon_content.image")){
            $rules['widgets.*.widget_data.account.icon.icon_content.image'] = "nullable|image|mimes:jpeg,png,jpg|max:2048";
        }

        $messages = [
            'widgets.*.widget_type.required' => 'The widget type is required.',
            'widgets.*.widget_type.string' => 'The widget type must be a valid string.',
            'widgets.*.widget_data.required' => 'The widget data is required.',

            // logo validation
            'widgets.*.widget_data.logo.image' => 'The logo must be a valid image file.',
            'widgets.*.widget_data.logo.max' => 'The logo must not be greater than 2MB.',
            'widgets.*.widget_data.logo.required' => 'The logo is required.',

            // menu validation
            'widgets.*.widget_data.menu.required' => 'The menu is required.',
            'widgets.*.widget_data.menu.exists' => 'The menu not found.',

            // account icon validation
            'widgets.*.widget_data.account.icon.icon_content.image' => 'The account icon image must be a valid image file.',
            'widgets.*.widget_data.account.icon.icon_content.image.max' => 'The account icon image must not be greater than 2MB.',

        ];

        $request->validate($rules, $messages);
        
        $data = $request->widgets;

        if(isset($data) && is_array($data)){
            foreach ($data as $key => $value) {
                if($value['widget_type'] == 'header-1'){
                    foreach($value['widget_data'] as $k => $item){

                        // LANGUAGE SWITCH
                        // ------------------------------------------------
                        if(array_key_exists('language_switch', $value['widget_data'])){
                            $data[$key]['widget_data']['language_switch'] = 1;
                        }else{
                            $data[$key]['widget_data']['language_switch'] = 0;
                        }

                        // SEARCH SWITCH
                        // ------------------------------------------------
                        if(array_key_exists('search_switch', $value['widget_data'])){
                            $data[$key]['widget_data']['search_switch'] = 1;
                        }else{
                            $data[$key]['widget_data']['search_switch'] = 0;
                        }

                        // ACOOUNT 
                        // ------------------------------------------------
                        
                        if($k == 'account'){
                            if($value['widget_data']['account']['icon']['icon_type'] == 'image' && $request->hasFile("widgets.$key.widget_data.account.icon.icon_content.image")){
                                $avatar_path = storeMedia($request->file("widgets.$key.widget_data.account.icon.icon_content.image"), 'page');
                                $data[$key]['widget_data']['account']['icon']['icon_content']['image'] = $avatar_path;
                            }else{
                                $data[$key]['widget_data']['account']['icon']['icon_content']['image'] = $value['widget_data']['account']['icon']['icon_type'] == 'image' ? $data[$key]['widget_data']['account']['icon']['icon_content']['image_db'] : null;
                            }

                            if(array_key_exists('target', $data[$key]['widget_data']['account'])){
                                $data[$key]['widget_data']['account']['target'] = 1;
                                $data[$key]['widget_data']['account']['follow'] = 1;
                            }else{
                                $data[$key]['widget_data']['account']['target'] = 0;
                                $data[$key]['widget_data']['account']['follow'] = 0;
                            }
                        }

                        // BUTTON
                        // ------------------------------------------------
                        if($k == 'button'){
                            
                            if(array_key_exists('target', $data[$key]['widget_data']['button'])){
                                $data[$key]['widget_data']['button']['target'] = 1;
                                $data[$key]['widget_data']['button']['follow'] = 1;
                            }else{
                                $data[$key]['widget_data']['button']['target'] = 0;
                                $data[$key]['widget_data']['button']['follow'] = 0;
                            }
                        }

                        // LOGO
                        // ------------------------------------------------
                        if($k == 'logo' && $request->hasFile("widgets.$key.widget_data.logo")){
                            $logo_path = storeMedia($request->file("widgets.$key.widget_data.logo"), 'page');
                            $data[$key]['widget_data']['logo'] = $logo_path;
                            dd($logo_path);
                        }else{
                            $data[$key]['widget_data']['logo'] = $data[$key]['widget_data']['logo_db'];
                            dd($data[$key]['widget_data']['logo']);
                        }

                        // REPEATER
                        // ------------------------------------------------
                        if($k == 'repeater'){
                            foreach($item as $rep => $rep_item){
                                
                                if($rep_item['icon']['icon_type'] == 'image' && $request->hasFile("widgets.$key.widget_data.repeater.$rep.icon.icon_content.image")){
                                    $icon_image_path = storeMedia($request->file("widgets.$key.widget_data.repeater.$rep.icon.icon_content.image"), 'page');
                                    $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image'] = $icon_image_path;
                                }
                                else{
                                    $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image'] = $rep_item['icon']['icon_type'] == 'image' ? $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image_db'] : null;
                                }
                            }
                        }
                    }
                }
            }

        }

        dd($data);

        $page = Page::findOrFail($id);
        $page->widgets = $data ?? [];
        $page->save();
        
       
        return redirect()->route('admin.pages.index')->with('success', 'Widgets updated successfully.');
    }
    

}
