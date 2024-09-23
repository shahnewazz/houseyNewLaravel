<?php

namespace Modules\Core\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Core\Http\Requests\LanguageRequest;
use Modules\Core\Models\Language;

class LanguageController extends Controller
{

    public function index()
    {
        $languages = Language::all();
        return view('core::languages.index', compact('languages'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('core::languages.edit', compact('language'));

    }

    public function create()
    {
        return view('core::languages.create');
    }

    public function store(LanguageRequest $request)
    {

        $language = new Language(); 
        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction;
        $language->save();

        $default_lang = Language::where('isDefault', 1)->first();
        $source = resource_path('lang/'.$default_lang->code);
        $destination = resource_path('lang/'.$request->code);

        if(!File::exists($destination)){
            File::makeDirectory($destination);
        }

        $files = File::allFiles($source);
        foreach($files as $file){
            File::copy($file, $destination.'/'.basename($file));
        }

        return redirect()->route('languages.index')->with('success', 'Language created successfully');

    }

    public function update(LanguageRequest $request, $id)
    {
        $language = Language::findOrFail($id);
        $oldCode = $language->code;

        if($oldCode != $request->code){
            $source = resource_path('lang/'.$oldCode);
            $destination = resource_path('lang/'.$request->code);

            if(!File::exists($destination)){
                File::makeDirectory($destination);
            }

            $files = File::allFiles($source);
            foreach($files as $file){
                File::copy($file, $destination.'/'.basename($file));
            }

            File::deleteDirectory($source);
        }

        $language->name = $request->name;
        $language->code = $request->code;
        $language->direction = $request->direction;
        $language->save();

        return redirect()->route('languages.index')->with('success', 'Language updated successfully');
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        

        if($language->isDefault == 1){
            return redirect()->route('languages.index')->with('error', 'Default language can not be deleted');
        }

        // delete the transalation folder if exits
        $path = resource_path('lang/'.$language->code);
        if(File::exists($path)){
            File::deleteDirectory($path);
        }



        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
    }

    public function default(Request $request)
    {
        if($request->ajax()){
            $languages = Language::all();

            foreach($languages as $language){
                $language->isDefault =  $language->id == $request->id ? 1 : 0;
                if($language->isDefault == 1){
                    $language->status = 1;
                }
                $language->save();
            }

            $html = view('core::languages._lang-table', compact('languages'))->render();
            return response()->json(['html' => $html]);

        }
       

        
    }

    public function status(Request $request)
    {

        $languages = Language::all();
        $language = $languages->where('id', $request->id)->first();

        

        if($language->isDefault == 1){
            $html = view('core::languages._lang-table', compact('languages'))->render();
            return response()->json([
                'error' => 'Default language can not be disabled',
                'html' => $html
            ], 400);
        }

        $language->status = $request->status;
        $language->save();
        
        
        $html = view('core::languages._lang-table', compact('languages'))->render();
        return response()->json(['html' => $html]);
    }


    public function showTranslations($lang, $file)
    {
        // Path to the JSON file inside the lang directory
        $filePath = resource_path("lang/{$lang}/{$file}.php");

        // Check if the file exists
        if (File::exists($filePath)) {
            // Read and decode the JSON file
            // $translations = json_decode(File::get($filePath), true);
            $translations = include $filePath;
        } else {
            // Return an empty array or error if the file is not found
            $translations = [];
        }

        return view('core::languages.translation', compact('translations', 'lang', 'file'));
    }

    public function translate($code)
    {

        $language = Language::select('name')->where('code', $code)->first();
        $files = File::glob(resource_path("lang/{$code}/*.php"));
   
        // retrieve the file name without the extension
        $files = array_map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        }, $files);


        return view('core::languages.translate', compact('files', 'code', 'language'));
        
    }


    public function updateTranslation(Request $request)
    {
        // Validate the input
        $request->validate([
            'key' => 'required|string',
            'value' => 'required|string',
            'lang' => 'required|string',
            'file' => 'required|string'
        ]);

        // Define the path of the JSON file dynamically
        $filePath = resource_path("lang/{$request->lang}/{$request->file}.php");

        // Check if the file exists
        if (!File::exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Get the file contents and decode the JSON
        $translations = json_decode(File::get($filePath), true);

        // Update the translation key with the new value
        if (array_key_exists($request->key, $translations)) {
            $translations[$request->key] = $request->value;
            
            // Write the updated translations back to the JSON file
            // File::put($filePath, json_encode($translations, JSON_PRETTY_PRINT));
            $content = "<?php\n\nreturn ".var_export($translations, true).";\n";
            
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Key not found'], 400);
    }
    
}
