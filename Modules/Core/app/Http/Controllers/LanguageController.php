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
               
        return redirect()->route('languages.index')->with('success', 'Language created successfully');

    }

    public function update(LanguageRequest $request, $id)
    {
        $language = Language::findOrFail($id);

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

        $language->delete();
        return redirect()->route('languages.index')->with('success', 'Language deleted successfully');
    }

    // public function default(Request $request)
    // {
    //     DB::table('language')->update(['isDefault' => 0]);
    //     DB::table('language')->where('id', $request->id)->update(['isDefault' => 1]);

    //     return redirect()->route('languages.index')->with('success', 'Default language updated successfully');
    // }

    // public function status(Request $request)
    // {
        
    //     $language = Language::findOrFail($request->id);

    //     if($language->isDefault == 1){
    //         return redirect()->route('languages.index')->with('error', 'Default language can not be disabled');
    //     }

    //     $language->status = $request->status == '1' ? 1 : 0;
    //     $language->save();

    //     return redirect()->route('languages.index')->with('success', 'Status updated successfully');
    // }




    
}
