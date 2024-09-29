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
        // get all users except super admin 
        $query = User::whereNotIn('username', ['super_admin'])->orderByDesc('created_at');

        // Apply the search filter if it exists
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate the results
        $users = $query->paginate(10);


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


    public function store(UserStoreRequest $request)
    {
      
        $user = User::create($request->validated());

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }


    public function show($username)
    {
        
        $user = User::where('username', $username)->first();
        return view('core::pages.users.user-single', compact('user'))->render();
    }


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

    public function destroy($username)
    {
        //
    }
}
