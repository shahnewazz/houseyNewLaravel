<?php

namespace Modules\Core\Http\Controllers;


use Illuminate\Http\Request;
use Modules\Core\Http\Requests\LanguageUpdateRequest;
use Modules\Core\Models\Language;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Core\Http\Requests\LanguageRequest;

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

        if($request->code == 'en'){
            return redirect()->route('admin.languages.index')->with('error', 'English language already exists');
        }

        $language = Language::create($request->validated());

        // store the language image if exists
        if($request->hasFile('lang_img')){
            $request->validate([
                'lang_img' => 'image|mimes:png,jpg,jpeg|max:512'
            ]);

            $image = $request->file('lang_img');
            $imageName = $request->code.'.'.$image->getClientOriginalExtension();
            
            $imagePath = $image->storeAs('languages', $imageName, 'public');

            $language->image = $imagePath;
            $language->save();
        }

        

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

        return redirect()->route('admin.languages.index')->with('success', 'Language created successfully');

    }

    public function update(LanguageUpdateRequest $request, $id)
    {


        $language = Language::findOrFail($id);
        $oldCode = $language->code;

        if($oldCode != $request->code){
            // rename directory with the new code
            $oldPath = resource_path('lang/'.$oldCode);
            $newPath = resource_path('lang/' . $request->code);
            
            // check if the directory exists
            if(File::exists($oldPath)){
                if(!rename($oldPath, $newPath)){
                    return redirect()->back()->with('error','Cannot rename the language directory');
                };
            }   

            
        }

        $language->code = $request->code;
        $language->name = $request->name;
        $language->direction = $request->direction;

        if($request->hasFile('lang_img')){
            $request->validate([
                'lang_img' => 'image|mimes:png,jpg,jpeg|max:512'
            ]);

            $image = $request->file('lang_img');
            $imageName = $request->code.'.'.$image->getClientOriginalExtension();
            
            $imagePath = $image->storeAs('languages', $imageName, 'public');

            // delete the old image
            if(isset($language->image) && File::exists(storage_path('app/public/'.$language->image))){
                File::delete(storage_path('app/public/'.$language->image));
            }

            $language->image = $imagePath;
        }
       
        $language->save();

        return redirect()->route('admin.languages.index')->with('success', 'Language updated successfully');
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        

        if($language->isDefault == 1){
            return redirect()->route('admin.languages.index')->with('error', 'Default language can not be deleted');
        }

        // delete the transalation folder if exits
        $path = resource_path('lang/'.$language->code);
        if(File::exists($path)){
            File::deleteDirectory($path);
        }



        $language->delete();
        return redirect()->route('admin.languages.index')->with('success', 'Language deleted successfully');
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

            $code = $languages->where('id', $request->id)->first()->code;

            // update env file
            $envFile = app()->environmentFilePath();
            $env = file_get_contents($envFile);
            $env = preg_replace('/APP_LOCALE=(.*)/', 'APP_LOCALE='.$code, $env);
            file_put_contents($envFile, $env);
            

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

        $filePath = resource_path("lang/{$lang}/{$file}.php");


        if (File::exists($filePath)) {
            $translations = include $filePath;
        } else {
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
        

        $filePath = resource_path("lang/{$request->lang}/{$request->file}.php");


        if (!File::exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $translations = include $filePath;

        if (array_key_exists($request->key, $translations)) {
            $translations[$request->key] = $request->value;
            
           
            $content = "<?php\n\nreturn ".var_export($translations, true).";\n";
            
            $path = resource_path("lang/$request->lang/$request->file.php");

            File::put($path, $content);

            if(File::exists($path)){
                return response()->json(['success' => 'Translation updated successfully']);
            }
        }

        return response()->json(['error' => 'Key not found'], 400);
    }
    

    public function changeLanguage($code)
    {
        if(setLanguage($code)){
            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Language not found');
    }

}
