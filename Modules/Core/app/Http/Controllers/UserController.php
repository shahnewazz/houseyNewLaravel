<?php

namespace Modules\Core\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Core\Http\Requests\User\UserStoreRequest;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:users-show', only:['index', 'store']),
            new Middleware('permission:users-create', only:['create', 'store']),
            new Middleware('permission:users-edit', only:['edit', 'update']),
            new Middleware('permission:users-delete', only:['destroy']),
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Get all users except super admin
        $query = User::whereNotIn('username', ['super_admin'])->orderByDesc('created_at');

        // Apply the search filter if it exists
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Apply the role filter only if role exists and is not null
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Paginate the results
        $users = $query->paginate(10);

        if ($request->ajax()) {
            // Debug users if needed
            // dd($users);
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
        if($username == 'super_admin'){
            return response()->json(['error' => 'Super Admin Account Cannot Be Viewed'], 422);
        }
        $user = User::where('username', $username)->first();
        return view('core::pages.users.user-single', compact('user'))->render();
    }


    public function edit($username)
    {
        if($username == "super_admin"){
            return redirect()->back()->with('error','Super Admin Account Cannot Be Edited');
        }

        $user = User::where('username', $username)->first();

        return view('core::pages.users.user-edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $username)
    {
        dd($request->all());
    }

    public function destroy($username)
    {
        if($username == 'super_admin'){
            return redirect()->back()->with('error','Super Admin Account Cannot Be Deleted');
        }

        $user = User::where('username', $username)->first();
        // remove user role 
        $user->syncPermissions('');

        // deleter user avatar
        if($user->profile_picture){
            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success','User deleted successfully');
    }
}
