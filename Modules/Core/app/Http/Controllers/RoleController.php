<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Modules\Core\Http\Requests\RoleStoreRequest;
use Modules\Core\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{

    protected function checkRoleByID($id, $type = 'id'){

        if($type == 'id'){
            if($id == 1){
                return ['status' => true, 'message'=> 'You can\'t edit Super Admin role'];
            }elseif($id == 2){
                return ['status' => true, 'message'=> 'You can\'t edit Default User role'];
            }elseif($id == 3){
                return ['status' => true, 'message'=> 'You can\'t edit Default Admin role'];
            }else{
                return ['status' => false];
            }
        }elseif($type == 'name'){
            if($id == 'super_admin'){
                return ['status' => true, 'message'=> 'You can\'t edit Super Admin role'];
            }elseif($id == 'default_user'){
                return ['status' => true, 'message'=> 'You can\'t edit Default User role'];
            }elseif($id == 'default_admin'){
                return ['status' => true, 'message'=> 'You can\'t edit Default Admin role'];
            }else{
                return ['status' => false];
            }
        }
      
    }


    public function index()
    {
        // get all roles expect super admin, default user and default admin
        $roles = Role::whereNotIn('name', ['super_admin', 'default_user', 'default_admin'])->get();

        // get users count for each role
        foreach ($roles as $role) {
            $role->users_count = $role->users()->count();
        }
        
        return view('core::pages.roles.roles', compact('roles'));
    }


    public function create()
    {

        return view('core::pages.roles.create');
    }


    public function store(RoleStoreRequest $request)
    {

        if($this->checkRoleByID($request->name, 'name')['status']){
            return redirect()->route('admin.roles.index')->with('error',$this->checkRoleByID($request->name, 'name')['message']);
        }

        $role = Role::create(['name' => $request->name]);

        if(!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('success','Role created successfully');
        
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // if try to edit super admin role then redirect back with error message

        if($this->checkRoleByID($id)['status']){
            return redirect()->route('admin.roles.index')->with('error',$this->checkRoleByID($id)['message']);
        }

        $role = Role::findOrFail($id);
        
        
        $permissions = Permission::all();
        return view('core::pages.roles.edit', compact('role','permissions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        if($this->checkRoleByID($id)['status']){
            return redirect()->route('admin.roles.index')->with('error',$this->checkRoleByID($id)['message']);
        }

        $role = Role::findOrFail($id);        
        $role->name = $request->name;
        $role->save();

        if (!empty($request->permissions)) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('success','Role updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        if($this->checkRoleByID($id)['status']){
            return redirect()->route('admin.roles.index')->with('error',$this->checkRoleByID($id)['message']);
        }
        

        $role = Role::findOrFail($id);
        $role->permissions()->detach();

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success','Role deleted successfully');
        
    }
}
