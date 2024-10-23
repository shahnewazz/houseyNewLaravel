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


        $widgets = $request->widgets ?? [];

        $widgetTypes = array_map(function ($widget) {
            return $widget['widget_type'] ?? null; // Safely get widget_type
        }, $widgets);


        foreach($widgetTypes as $item){
            if($item == 'header-1'){
                $rules = [
                    'widgets.*.widget_data.menu' => 'nullable|exists:menus,id',
                    'widgets.*.widget_data.logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'widgets.*.widget_data.account' => 'required|array',
                    'widgets.*.widget_data.account.icon' => 'required|array',
                    'widgets.*.widget_data.account.icon.icon_type' => 'required|string',
                    'widgets.*.widget_data.account.icon.icon_content' => 'required|array',
                    'widgets.*.widget_data.account.icon.icon_content.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'widgets.*.widget_data.account.icon.icon_content.image_db' => 'nullable|string',
                    'widgets.*.widget_data.account.icon.icon_content.svg' => 'nullable|string',

                    'widgets.*.widget_data.account.lang' => 'required|array',
                    'widgets.*.widget_data.account.lang.*.text' => 'nullable|string',
                    'widgets.*.widget_data.account.url' => 'nullable|string',
                    'widgets.*.widget_data.account.target' => 'nullable|string',
                    'widgets.*.widget_data.account.follow' => 'nullable|string',

                    'widgets.*.widget_data.button' => 'required|array',
                    'widgets.*.widget_data.button.lang' => 'required|array',
                    'widgets.*.widget_data.button.lang.*.text' => 'nullable|string',
                    'widgets.*.widget_data.button.url' => 'nullable|string',
                    'widgets.*.widget_data.button.target' => 'nullable|string',
                    'widgets.*.widget_data.button.follow' => 'nullable|string',


                    'widgets.*.widget_data.repeater' => 'required|array',
                    'widgets.*.widget_data.repeater.*.url' => 'nullable|string',
                    'widgets.*.widget_data.repeater.*.lang' => 'required|array',
                    'widgets.*.widget_data.repeater.*.lang.*.text' => 'nullable|array',
                    'widgets.*.widget_data.repeater.*.icon' => 'required|array',
                    'widgets.*.widget_data.repeater.*.icon.icon_type' => 'required|string',
                    'widgets.*.widget_data.repeater.*.icon.icon_content' => 'required|array',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image_db' => 'nullable|string',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.svg' => 'nullable|string',


                ];

                if($request->hasFile("widgets.*.widget_data.account.icon.icon_content.image")){
                    $rules['widgets.*.widget_data.account.icon.icon_content.image'] = "nullable|image|mimes:jpeg,png,jpg|max:2048";
                }   

                if($request->hasFile("widgets.*.widget_data.repeater.*.icon.icon_content.image")){
                    $rules['widgets.*.widget_data.repeater.*.icon.icon_content.image'] = "nullable|image|mimes:jpeg,png,jpg|max:2048";
                }

                $messages = [
                    'widgets.*.widget_data.menu.exists' => 'Menu not found.',
                    'widgets.*.widget_data.logo.image' => 'The logo must be an image.',
                    'widgets.*.widget_data.logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg.',
                    'widgets.*.widget_data.logo.max' => 'The logo may not be greater than 2048 kilobytes.',
                    'widgets.*.widget_data.account.required' => 'The account field is required.',
                    'widgets.*.widget_data.account.icon.required' => 'The icon field is required.',
                    'widgets.*.widget_data.account.icon.icon_type.required' => 'The icon type field is required.',
                    'widgets.*.widget_data.account.icon.icon_content.required' => 'The icon content field is required.',
                    'widgets.*.widget_data.account.icon.icon_content.image.image' => 'The icon content image must be an image.',
                    'widgets.*.widget_data.account.icon.icon_content.image.mimes' => 'The icon content image must be a file of type: jpeg, png, jpg.',
                    'widgets.*.widget_data.account.icon.icon_content.image.max' => 'The icon content image may not be greater than 2048 kilobytes.',
                    'widgets.*.widget_data.account.icon.icon_content.image_db.string' => 'The icon content image db must be a string.',
                    'widgets.*.widget_data.account.icon.icon_content.svg.string' => 'The icon content svg must be a string.',
                    'widgets.*.widget_data.account.lang.required' => 'The account lang field is required.',
                    'widgets.*.widget_data.account.lang.*.text.string' => 'The account text must be a string.',
                    'widgets.*.widget_data.account.url.string' => 'The account url must be a string.',
                    'widgets.*.widget_data.account.target.string' => 'The account target must be a string.',
                    'widgets.*.widget_data.account.follow.string' => 'The account follow must be a string.',
                    'widgets.*.widget_data.button.required' => 'The button field is required.',
                    'widgets.*.widget_data.button.lang.required' => 'The button lang field is required.',
                    'widgets.*.widget_data.button.lang.*.text.string' => 'The button text must be a string.',
                    'widgets.*.widget_data.button.url.string' => 'The button url must be a string.',
                    'widgets.*.widget_data.button.target.string' => 'The button target must be a string.',
                    'widgets.*.widget_data.button.follow.string' => 'The button follow must be a string.',
                    'widgets.*.widget_data.repeater.required' => 'The repeater field is required.',
                    'widgets.*.widget_data.repeater.*.url.string' => 'The repeater url must be a string.',
                    'widgets.*.widget_data.repeater.*.lang.required' => 'The repeater lang field is required.',
                    'widgets.*.widget_data.repeater.*.lang.*.text.string' => 'The repeater text must be a string.',
                    'widgets.*.widget_data.repeater.*.icon.required' => 'The repeater icon field is required.',
                    'widgets.*.widget_data.repeater.*.icon.icon_type.required' => 'The repeater icon type field is required.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.required' => 'The repeater icon content field is required.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image.image' => 'The repeater icon content image must be an image.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image.mimes' => 'The repeater icon content image must be a file of type: jpeg, png, jpg.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image.max' => 'The repeater icon content image may not be greater than 2048 kilobytes.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.image_db.string' => 'The repeater icon content image db must be a string.',
                    'widgets.*.widget_data.repeater.*.icon.icon_content.svg.string' => 'The repeater icon content svg must be a string.',

                ];

                $request->validate($rules, $messages);
            }
        }

        $rules = [];

        $rules['widgets.*.widget_type'] = 'nullable|string';
        $rules['widgets.*.widget_data'] = 'nullable|array';



        $messages = [];
        $messages['widgets.*.widget_type.string'] = 'The widget type must be a string.';
        $messages['widgets.*.widget_data.array'] = 'The widget data must be an array.';

        $request->validate($rules, $messages);

        $data = $request->widgets;

        if(isset($data) && is_array($data)){
            foreach ($data as $key => $value) {
                // header -1 validation
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
                        if(array_key_exists('account', $value['widget_data'])){
                            if($k == 'account' ){
                                if(array_key_exists('icon', $data[$key]['widget_data']['account'])){
    
                                    if(array_key_exists('icon_type', $data[$key]['widget_data']['account']['icon']) && array_key_exists('icon_content', $data[$key]['widget_data']['account']['icon'])){
                                        
                                        if($value['widget_data']['account']['icon']['icon_type'] == 'image' && $request->hasFile("widgets.$key.widget_data.account.icon.icon_content.image")){
                                            $avatar_path = updateMedia($request->file("widgets.$key.widget_data.account.icon.icon_content.image"), $value['widget_data']['account']['icon']['icon_content']['image_db'], 'page');
                                            $data[$key]['widget_data']['account']['icon']['icon_content']['image'] = $avatar_path;
                                        }else{
                                            if(array_key_exists('image_db', $data[$key]['widget_data']['account']['icon']['icon_content'])){
                                                $data[$key]['widget_data']['account']['icon']['icon_content']['image'] = $value['widget_data']['account']['icon']['icon_type'] == 'image' ? $data[$key]['widget_data']['account']['icon']['icon_content']['image_db'] : null;
                                            }
                                        }
                                    }else{
                                        return response()->json(['message' => 'Some Fields are missing in Accounts', 'status' => false], 422);
                                    }
        
    
    
                                    // target
                                    if(array_key_exists('target', $data[$key]['widget_data']['account'])){
                                        $data[$key]['widget_data']['account']['target'] = 1;
                                    }else{
                                        $data[$key]['widget_data']['account']['target'] = 0;
                                    }
    
                                    // follow
                                    if(array_key_exists('follow', $data[$key]['widget_data']['account'])){
                                        $data[$key]['widget_data']['account']['follow'] = 1;
                                    }else{
                                        $data[$key]['widget_data']['account']['follow'] = 0;
                                    }
                                }
    
                                if(!array_key_exists('text', $data[$key]['widget_data']['account']['lang']['en']) || !array_key_exists('url', $data[$key]['widget_data']['account'])){
                                    return response()->json(['message' => 'Some Fields are missing in Accounts', 'status' => false], 422);
                                }
    
                            }
                        }else{
                            return response()->json(['message' => 'Some Fields are missing in Account', 'status' => false], 422);
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
                        if(array_key_exists('logo_db', $data[$key]['widget_data'])){
                            if($k == 'logo' && $request->hasFile("widgets.$key.widget_data.logo")){
                                $logo_path = updateMedia($request->file("widgets.$key.widget_data.logo"), $value['widget_data']['logo_db'], 'page');
                                $data[$key]['widget_data']['logo'] = $logo_path;
                               
                            }else{
                                $data[$key]['widget_data']['logo'] = $data[$key]['widget_data']['logo_db'];
                                
                            }
                        }else{
                            return response()->json(['message' => 'Some Fields are missing in Logo', 'status' => false], 422);
                        }


                        // REPEATER
                        // ------------------------------------------------
                        if(array_key_exists('repeater', $data[$key]['widget_data'])){
                            if($k == 'repeater'){
                                foreach($item as $rep => $rep_item){
                                    
                                    if(!array_key_exists('url', $rep_item) || !array_key_exists('lang', $rep_item) || !array_key_exists('en', $rep_item['lang']) || !array_key_exists('text', $rep_item['lang']['en'])){
                                        return response()->json(['message' => 'Some Fields are missing in Repeater Items', 'status' => false], 422);
                                    }


                                    if(array_key_exists('icon', $rep_item) && array_key_exists('icon_type', $rep_item['icon'])){
                                        if(array_key_exists('icon_content', $rep_item['icon'])){
                                            if($rep_item['icon']['icon_type'] == 'image' && $request->hasFile("widgets.$key.widget_data.repeater.$rep.icon.icon_content.image")){
                                                $icon_image_path = updateMedia($request->file("widgets.$key.widget_data.repeater.$rep.icon.icon_content.image"), $rep_item['icon']['icon_content']['image_db'], 'page');
                                                $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image'] = $icon_image_path;
                                            }
                                            else{
                                                $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image'] = $rep_item['icon']['icon_type'] == 'image' ? $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content']['image_db'] : null;
                                            }
                                        }else{
                                            $data[$key]['widget_data']['repeater'][$rep]['icon']['icon_content'] = ['image' => null, 'image_db' => null, 'svg' => null];
                                        }
                                    }else{
                                        return response()->json(['message' => 'Some Fields are missing in Repeater Items', 'status' => false], 422);
                                    } 
                                }
                            }
                        }else{
                            return response()->json(['message' => 'Some Fields are missing in Repeater', 'status' => false], 422);
                           
                        }
                    }
                }
                
                // facilities validation

                // if($value['widget_type'] == 'facilities'){
                //     foreach($value['widget_data'] & $k => $item){

                //     }
                // }
            }

        }


        $page = Page::findOrFail($id);
        $page->widgets = $data ?? [];
        $page->save();
        
       
        return response()->json(['message' => 'Widgets saved successfully.'], 200);

    }
    

}
