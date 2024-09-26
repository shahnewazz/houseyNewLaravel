<?php

namespace Modules\Core\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Http\Requests\User\UserStoreRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        // Search filters
        $query = User::query();

        

        if($request->has('search')) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('created_at','desc')->paginate(10);


        if ($request->ajax()) {
            return view('core::pages.users.partials._users-table', compact('users'))->render();
        }

        return view('core::pages.users.users-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('core::pages.users.create-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($username)
    {
        
        $user = User::where('username', $username)->first();
        return view('core::pages.users.user-single', compact('user'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username)
    {
        return view('core::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username)
    {
        //
    }
}
