<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Models\Page;
use App\Http\Controllers\Controller;

class CoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug = null)
    {

        if(is_null($slug)){
            $page = Page::where('is_home', 1)->first();
            return view('core::frontend.index', compact('page'));
        }

        $page = Page::where('slug', $slug)->first();

        if(!$page){
            abort(404);
        }
        
        if($page->is_home){
            return redirect('/');
        }
        
        return view('core::frontend.index', compact('page'));

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

    /**
     * Change the language of the application.
     */
    public function setLang(Request $request, $code)
    {
        $request->validate([
            'code' => 'required|string|exists:language,code'
        ]);

        if(setLanguage($code)){
            return response()->json(['message' => 'Language changed successfully', 'status' => true], 200);
        }

        return response()->json(['message' => 'Language not found', 'status' => false], 422);

    }

}
