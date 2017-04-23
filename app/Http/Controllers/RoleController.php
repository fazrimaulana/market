<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Auth;
use App\User;
use App\RoleUser;
use App\Permission;
use App\PermissionRole;

use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_role')):

    		$roles = Role::paginate(20);
    		return view('backend.role.index', [
    			"roles" => $roles
    		]);

    	else:

    		return abort('404');

    	endif;
    }

    public function store(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_role')):

    		$this->validate($request, [
    				"name" => 'required|unique:roles,name',
    				"display_name" => 'required'
    			]);

    		$role = new Role();
    		$role->name = $request->name;
    		$role->display_name = $request->display_name;
    		$role->description = $request->description;

    		$role->save();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

    public function getData(Request $request, Role $role)
    {
    	if($request->ajax()):

    		return response()->json($role);

    	else:

    		return abort('404');

    	endif;
    }

    public function update(Request $request)
    {

    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_role')):

    		$role = Role::find($request->id);

    		$this->validate($request, [
    				"name" => ['required', Rule::unique('roles')->ignore($role->name, 'name')],
    				"display_name" => 'required'
    			]);

    		$role->name = $request->name;
    		$role->display_name = $request->display_name;
    		$role->description = $request->description;

    		$role->save();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;

    }

    public function delete(Request $request)
    {

    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_role')):

    		$role = Role::whereId($request->id);

    		$role->delete();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;

    }


    public function view(Role $role)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_role')):

    		$roleUserId = RoleUser::where('role_id', $role->id)->get()->pluck('user_id');
    		$users = User::whereNotIn('id', $roleUserId)->get();

    		$rolePermissionId = PermissionRole::where('role_id', $role->id)->get()->pluck('permission_id');
    		$permissions = Permission::whereNotIn('id', $rolePermissionId)->get();

    		return view('backend.role.view', [
    			"role" => $role,
    			"users" => $users,
    			"permissions" => $permissions
    		]);

    	else:

    		return abort('404');

    	endif;
    }

    public function adduser(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_role_user')):

    		$this->validate($request,[
    				"user" => "required"
    			]);

    		$role = Role::find($request->id);

    		$role->users()->attach($request->user);

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

    public function deleteuser(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_role_user')):

    		RoleUser::where('user_id', $request->userid)->where('role_id', $request->roleid)->delete();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

    public function addpermission(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_role_permission')):

    		$this->validate($request,[
    				"permission" => "required"
    			]);

    		$role = Role::find($request->id);

    		$role->perms()->attach($request->permission);

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

    public function deletepermission(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_role_permission')):

    		PermissionRole::where('role_id', $request->roleid)->where('permission_id', $request->permissionid)->delete();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

}
