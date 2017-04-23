<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;

use Auth;

class CategoriesController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_categories')):

    	    $categories = Categories::paginate(10);
    	    return view('backend.categories.index',[
    		 	"categories" => $categories
    		]);

        else:

            return abort('404');

        endif;
    }

    public function store(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_categories')):

            $this->validate($request, [
                "name" => "required"
            ]);

            Categories::create([
                "name" => $request->name
            ]);

            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

    public function getAjaxData(Categories $category, Request $request)
    {
    	if($request->ajax()):
    		return response()->json($category);
    	else:
    		return abort('404');
    	endif;
    }

    public function update(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_categories')):

            $this->validate($request, [
                "name" => "required"
            ]);
            Categories::find($request->id)->update([
                "name" => $request->name
            ]);
            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

    public function delete(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_categories')):

            Categories::find($request->id)->delete();
            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

}
