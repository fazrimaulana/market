<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_user') || Auth::user()):

    	$users = User::paginate(10);
        $roles = Role::all();

    	return view('backend.users.index', [
    			"users" => $users,
                "roles" => $roles
    		]);

        else:

            return abort('404');
        
        endif;

    }

    /*public function admin()
    {
        $id    = Role::where('name', 'Admin')->first();
        $users = User::where('role_id', $id->id)->paginate(10);
        $roles = Role::all();
        
        return view('backend.users.index', [
                "users" => $users,
                "roles" => $roles
            ]);
    }

    public function seller()
    {
        $id    = Role::where('name', 'Seller')->first();
        $users = User::where('role_id', $id->id)->paginate(10);
        $roles = Role::all();

        return view('backend.users.index', [
                "users" => $users,
                "roles" => $roles
            ]);
    }

    public function buyer()
    {
        $id    = Role::where('name', 'Buyer')->first();
        $users = User::where('role_id', $id->id)->paginate(10);
        $roles = Role::all();

        return view('backend.users.index', [
                "users" => $users,
                "roles" => $roles
            ]);
    }*/

    public function store(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_user')):

            $this->validate($request, [
                "name" => "required",
                "email" => "required|unique:users",
                "role" => "required",
                "password" => "required"
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            $user->roles()->attach($request->role);

            return redirect()->back();
            
        else:

            return abort('404');

        endif;

    }

    public function getData(Request $request, User $user)
    {
        if($request->ajax()):
            $role = $user->roles()->pluck('id');
            return response()->json(["user" => $user, "role" => $role]);
        else:
            return abort('404');
        endif;
    }

    public function update(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_user') || Auth::user()->id==$request->id):

            $this->validate($request, [
                'name' => 'required',
                'email' => ['required', Rule::unique('users')->ignore($request->id),],
                'role' => 'required',
            ]);

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $user->roles()->sync($request->role);

            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

    public function delete(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_user')):

            User::find($request->id)->delete();
            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

    public function profile(User $user)
    {
        return view('backend.users.profile',[
                "user" => $user
            ]);
    }

    public function changePassword(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_user') || Auth::user()->id==$request->id):

            $this->validate($request, [
                'new_password' => 'required',
                'old_password' => 'required',
            ]);
            $user = User::find($request->id);
            if(Hash::check($request->old_password, $user->password)):
                $user->password = bcrypt($request->new_password);
                $user->save();
                return redirect()->back();
            else:
                return redirect()->back()->with('status', 'Change password failed');
            endif;

        else:

            return abort('404');
        
        endif;
    }

}
