<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

use Auth;

use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_permission')):

    		$permissions = Permission::paginate(20);
    		return view('backend.permission.index',[
    			"permissions" => $permissions
    		]);

    	else:

    		return abort('404');

    	endif;
    }

    public function store(Request $request)
    {
    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_permission')):

    		$this->validate($request, [
    				"name" => 'required|unique:permissions,name',
    				"display_name" => 'required'
    			]);

    		$permission = new Permission();
    		$permission->name = $request->name;
    		$permission->display_name = $request->display_name;
    		$permission->description = $request->description;

    		$permission->save();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;
    }

    public function getData(Request $request, Permission $permission)
    {
    	if($request->ajax()):

    		return response()->json($permission);

    	else:

    		return abort('404');

    	endif;
    }

    public function update(Request $request)
    {

    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_permission')):

    		$permission = Permission::find($request->id);

    		$this->validate($request, [
    				"name" => ['required', Rule::unique('permissions')->ignore($permission->name, 'name')],
    				"display_name" => 'required'
    			]);

    		$permission->name = $request->name;
    		$permission->display_name = $request->display_name;
    		$permission->description = $request->description;

    		$permission->save();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;

    }

    public function delete(Request $request)
    {

    	if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_permission')):

    		$permission = Permission::whereId($request->id);

    		$permission->delete();

    		return redirect()->back();

    	else:

    		return abort('404');

    	endif;

    }

}
