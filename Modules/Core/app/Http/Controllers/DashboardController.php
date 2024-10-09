<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Blog;
use Modules\Core\Models\Language;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function blog()
    {
        // Get all blogs with translations
        $blogs = Blog::with('translations')->get();
    
        // Get the current language from the session or default to 'en'
        $locale = App::getLocale(); // This gets the currently selected locale from the session or fallback to 'en'
    
        // Set English as the default language
        $defaultLanguage = 'en';
    
        // Prepare an array of translatable fields (e.g., title, description, content)
        $translatableFields = ['title'];
    
        // Array to store blogs with translations
        $translatedBlogs = [];
    
        // Loop through each blog and fetch the translations
        foreach ($blogs as $blog) {
            $translations = [];
    
            if ($locale != $defaultLanguage) {
                // If the selected language is not 'en', load translations
                foreach ($translatableFields as $field) {
                    // Fetch the translation for each field based on the current locale
                    $translatedField = $blog->translations()
                        ->where('language_code', $locale)
                        ->where('field_name', $field)
                        ->first();
                        
                    // Store the translation or fallback to original content if not available
                    $translations[$field] = $translatedField ? $translatedField->content : $blog->$field;
                }
            } else {
                // If the language is 'en', use the original content from the blog table
                foreach ($translatableFields as $field) {
                    $translations[$field] = $blog->$field;
                }
            }
    
            // Add the translated blog data (original + translations) to the array
            $translatedBlogs[] = [
                'blog' => $blog,
                'translations' => $translations
            ];
        }
    
        // Pass the translated blogs and the current locale to the view
        return view('core::frontend.index', compact('translatedBlogs', 'locale'));
    }
    


    public function getXss()
    {
        return view("core::xss-input");
    }
    public function xss(Request $request)
    {
        $data = $request->name;
        return view("core::xss", compact('data'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $languages = Language::all();
        return view('core::index', compact('user', 'languages'));
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
        //
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


    // get settings page
    public function settings(){
        return view('core::pages.settings.index');
    }
}
