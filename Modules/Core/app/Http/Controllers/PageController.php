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
        $page->widgets = unserialize($page->widgets);
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


        $rules = [];
        $messages = [];

        $rules['widgets.*.widget_type'] = 'nullable|string';
        $rules['widgets.*.widget_data'] = 'nullable|array';

        $messages['widgets.*.widget_type.string'] = 'The widget type must be a string.';
        $messages['widgets.*.widget_data.array'] = 'The widget data must be an array.';

        
        foreach ($request->input('widgets', []) as $index => $widget) {
            if ($widget['widget_type'] == 'header-1') {
                $rules["widgets.$index.widget_data.menu"] = 'nullable|exists:menus,id';
                $rules["widgets.$index.widget_data.logo"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["widgets.$index.widget_data.account"] = 'required|array';
                $rules["widgets.$index.widget_data.account.icon"] = 'required|array';
                $rules["widgets.$index.widget_data.account.icon.icon_type"] = 'required|string';
                $rules["widgets.$index.widget_data.account.icon.icon_content"] = 'required|array';
                $rules["widgets.$index.widget_data.account.icon.icon_content.image"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["widgets.$index.widget_data.account.icon.icon_content.image_db"] = 'nullable|string';
                $rules["widgets.$index.widget_data.account.icon.icon_content.svg"] = 'nullable|string';
        
                $rules["widgets.$index.widget_data.account.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.account.lang.*.text"] = 'nullable|string';
                $rules["widgets.$index.widget_data.account.url"] = 'nullable|string';
                $rules["widgets.$index.widget_data.account.target"] = 'nullable|string';
                $rules["widgets.$index.widget_data.account.follow"] = 'nullable|string';
        
                $rules["widgets.$index.widget_data.button"] = 'required|array';
                $rules["widgets.$index.widget_data.button.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.button.lang.*.text"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.url"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.target"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.follow"] = 'nullable|string';
        
                $rules["widgets.$index.widget_data.repeater"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.url"] = 'nullable|string';
                $rules["widgets.$index.widget_data.repeater.*.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.lang.*.text"] = 'nullable|string';
                $rules["widgets.$index.widget_data.repeater.*.icon"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.icon.icon_type"] = 'required|string';
                $rules["widgets.$index.widget_data.repeater.*.icon.icon_content"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.icon.icon_content.image"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["widgets.$index.widget_data.repeater.*.icon.icon_content.image_db"] = 'nullable|string';
                $rules["widgets.$index.widget_data.repeater.*.icon.icon_content.svg"] = 'nullable|string';
            }

            if($widget['widget_type'] == 'facilities'){

                $rules["widgets.$index.widget_data.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.lang.*.section_title"] = 'nullable|string';
                $rules["widgets.$index.widget_data.lang.*.section_subtitle"] = 'nullable|string';
                $rules["widgets.$index.widget_data.lang.*.section_description"] = 'nullable|string';

                $rules["widgets.$index.widget_data.repeater"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.lang.*.title"] = 'nullable|string';
                $rules["widgets.$index.widget_data.repeater.*.url"] = 'nullable|string';
                $rules["widgets.$index.widget_data.repeater.*.image"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["widgets.$index.widget_data.repeater.*.image_db"] = 'nullable|string';

                // messages
                $messages["widgets.$index.widget_data.lang.*.section_title.string"] = 'The section title must be a string.';
                $messages["widgets.$index.widget_data.lang.*.section_subtitle.string"] = 'The section subtitle must be a string.';
                $messages["widgets.$index.widget_data.lang.*.section_description.string"] = 'The section description must be a string.';
                $messages["widgets.$index.widget_data.repeater.*.lang.*.title.string"] = 'The title must be a string.';
                $messages["widgets.$index.widget_data.repeater.*.url.string"] = 'The url must be a string.';

                $messages["widgets.$index.widget_data.repeater.*.image.image"] = 'The image must be an image.';
                $messages["widgets.$index.widget_data.repeater.*.image.mimes"] = 'The image must be a file of type: jpeg, png, jpg.';
                $messages["widgets.$index.widget_data.repeater.*.image.max"] = 'The image may not be greater than 2048 kilobytes.';
                $messages["widgets.$index.widget_data.repeater.*.image_db.string"] = 'The image DB must be a string.';
            }
            
            if($widget['widget_type'] == 'slider-1'){


                $rules["widgets.$index.widget_data.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.lang.*.subtitle"] = 'nullable|string';
                $rules["widgets.$index.widget_data.lang.*.title"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button"] = 'required|array';
                $rules["widgets.$index.widget_data.button.lang"] = 'required|array';
                $rules["widgets.$index.widget_data.button.lang.*.text"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.url"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.target"] = 'nullable|string';
                $rules["widgets.$index.widget_data.button.follow"] = 'nullable|string';

                $rules["widgets.$index.widget_data.repeater"] = 'required|array';
                $rules["widgets.$index.widget_data.repeater.*.image"] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
                $rules["widgets.$index.widget_data.repeater.*.image_db"] = 'nullable|string';

                // messages
                $messages["widgets.$index.widget_data.lang.*.subtitle.string"] = 'The subtitle must be a string.';
                $messages["widgets.$index.widget_data.lang.*.title.string"] = 'The title must be a string.';
                $messages["widgets.$index.widget_data.button.lang.*.text.string"] = 'The button text must be a string.';
                $messages["widgets.$index.widget_data.button.url.string"] = 'The url must be a string.';
                $messages["widgets.$index.widget_data.button.target.string"] = 'The target must be a string.';
                $messages["widgets.$index.widget_data.button.follow.string"] = 'The follow must be a string.';


                $messages["widgets.$index.widget_data.repeater.*.image.image"] = 'The image must be an image.';
                $messages["widgets.$index.widget_data.repeater.*.image.mimes"] = 'The image must be a file of type: jpeg, png, jpg.';
                $messages["widgets.$index.widget_data.repeater.*.image.max"] = 'The image may not be greater than 2048 kilobytes.';
                $messages["widgets.$index.widget_data.repeater.*.image_db.string"] = 'The image DB must be a string.';
            }
        }
        

        $request->validate($rules, $messages);

        $data = $request->widgets;

        if(isset($data) && is_array($data)){
            foreach ($data as $key => $value) {
                // header -1 validation
                if($value['widget_type'] == 'header-1'){

    
                    if($request->hasFile("widgets.*.widget_data.account.icon.icon_content.image")){
                        $rules['widgets.*.widget_data.account.icon.icon_content.image'] = "nullable|image|mimes:jpeg,png,jpg|max:2048";
                    }   
    
                    if($request->hasFile("widgets.*.widget_data.repeater.*.icon.icon_content.image")){
                        $rules['widgets.*.widget_data.repeater.*.icon.icon_content.image'] = "nullable|image|mimes:jpeg,png,jpg|max:2048";
                    }
    


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
                                $data[$key]['widget_data']['logo_db'] = $logo_path;
                               
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

                // FACILITIES
                if($value['widget_type'] == 'facilities'){
                    foreach($value['widget_data'] as $k => $item){
                        if($k == 'repeater'){
                            foreach($item as $rep => $rep_item){
                                
                                if(!array_key_exists('lang', $rep_item) || !array_key_exists('en', $rep_item['lang']) || !array_key_exists('title', $rep_item['lang']['en']) || !array_key_exists('image_db', $rep_item)){
                                    return response()->json(['message' => 'Some Fields are missing in Facilities Items', 'status' => false], 422);
                                }

                                if($request->hasFile("widgets.$key.widget_data.repeater.$rep.image")){
                                    $image_path = updateMedia($request->file("widgets.$key.widget_data.repeater.$rep.image"), $rep_item['image_db'], 'page');
                                    $data[$key]['widget_data']['repeater'][$rep]['image'] = $image_path;
                                    $data[$key]['widget_data']['repeater'][$rep]['image_db'] = $image_path;
                                    
                                }else{
                                    $data[$key]['widget_data']['repeater'][$rep]['image'] = $data[$key]['widget_data']['repeater'][$rep]['image_db'];
                                }
                            }
                        }
                    }
                }

                // SLIDER 1
                if($value['widget_type'] == 'slider-1'){
                    foreach($value['widget_data'] as $k => $item){

                        // button data
                        if($k == 'button'){
                            if(array_key_exists('target', $data[$key]['widget_data']['button'])){
                                $data[$key]['widget_data']['button']['target'] = 1;
                                $data[$key]['widget_data']['button']['follow'] = 1;
                            }else{
                                $data[$key]['widget_data']['button']['target'] = 0;
                                $data[$key]['widget_data']['button']['follow'] = 0;
                            }
                        }

                        if($k == 'repeater'){
                            foreach($item as $rep => $rep_item){
                                if($request->hasFile("widgets.$key.widget_data.repeater.$rep.image")){
                                    $image_path = updateMedia($request->file("widgets.$key.widget_data.repeater.$rep.image"), $rep_item['image_db'], 'page');
                                    $data[$key]['widget_data']['repeater'][$rep]['image'] = $image_path;
                                    $data[$key]['widget_data']['repeater'][$rep]['image_db'] = $image_path;
                                    
                                }else{
                                    $data[$key]['widget_data']['repeater'][$rep]['image'] = $data[$key]['widget_data']['repeater'][$rep]['image_db'];
                                }
                            }
                        }
                    }
                }
            }
        }


        $page = Page::findOrFail($id);
        $page->widgets = serialize($data) ?? [];
        $page->save();
        
       
        return response()->json(['message' => 'Widgets saved successfully.'], 200);

    }
    

}
