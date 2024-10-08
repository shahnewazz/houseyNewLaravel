<?php

namespace Modules\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Models\Blog;
use Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('core::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::blog.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $blog = Blog::create([
            'title' => $request->title[0],
            'slug' => Str::slug($request->title[0]),
        ]);

        
        addTranslation($request, 'Modules\Core\Models\Blog', $blog->id);
        
        return redirect()->route('admin.blog.create')->with('success', 'Blog created successfully.');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::with('translations')->find($id);
        return view('core::blog.edit', compact('blog'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        $blog->update([
            'title' => $request->title[0],
            'slug' => Str::slug($request->title[0]),
        ]);

        
        updateTranslation($request, 'Modules\Core\Models\Blog', $id);
        
        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
