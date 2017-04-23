<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use Auth;

class CompanyController extends Controller
{
    //

	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{

		if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_company')):

           $company = Company::where('user_id', Auth::user()->id)->paginate(10);
			return view('backend.company.index', [
				"company" => $company
			]);

        else:

            return abort('404');

        endif;

	}

	public function store(Request $request)
	{
		if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_company')):

           $this->validate($request, [
           		"name" => "required",
           		"alamat" => "required",
           		"telepon" => "required|string|size:11",
           		"no_hp" => "required|string|size:12"
           	]);

       		Company::create([
       				"user_id" => Auth::user()->id,
       				"name" => $request->name,
       				"alamat" => $request->alamat,
       				"telepon" => $request->telepon,
       				"no_hp" => $request->no_hp
       			]);

       		return redirect()->back();

        else:

            return abort('404');

        endif;
	}

	public function getData(Request $request, Company $company)
	{
		if($request->ajax()):

			return response()->json($company);

		else:

			return abort('404');

		endif;
	}

	public function update(Request $request)
	{
		if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_company')):

           $this->validate($request, [
           		"name" => "required",
           		"alamat" => "required",
           		"telepon" => "required|string|size:11",
           		"no_hp" => "required|string|size:12"
           	]);

       		Company::find($request->id)->update([
       				"user_id" => Auth::user()->id,
       				"name" => $request->name,
       				"alamat" => $request->alamat,
       				"telepon" => $request->telepon,
       				"no_hp" => $request->no_hp
       			]);

       		return redirect()->back();

        else:

            return abort('404');

        endif;
	}

	public function delete(Request $request)
	{
		if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_company')):

       		Company::find($request->id)->delete();
       		return redirect()->back();

        else:

            return abort('404');

        endif;
	}

}
