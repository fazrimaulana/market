<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SubCategories;
use App\Categories;
use App\Product;
use Auth;

class SubCategoriesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_subcategories')):

            $sub_categories = SubCategories::paginate(10);
            $categories = Categories::all();
            return view('backend.sub_categories.index',[
                "sub_categories" => $sub_categories,
                "categories" => $categories
            ]);

        else:

            return abort('404');

        endif; 
    }

    public function store(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_subcategories')):

            $this->validate($request,[
                "categories" => "required",
                "name"       => "required"
            ]);

            SubCategories::create([
                "categories_id" => $request->categories,
                "name"          => $request->name
            ]);

            return redirect()->back();

        else:

            return abort('404');

        endif; 

    }

    public function getAjaxData(SubCategories $sub_category, Request $request)
    {
    	if($request->ajax()):
    		$category = Categories::find($sub_category->categories_id);
    		return response()->json(["sub_category" => $sub_category, "category" => $category]);
    	else:
    		return abort('404');
    	endif;
    }

    public function update(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_subcategories')):

            $this->validate($request,[
                "categories" => "required",
                "name"       => "required"
            ]);

            SubCategories::find($request->id)->update([
                "categories_id" => $request->categories,
                "name"          => $request->name
            ]);

            return redirect()->back();

        else:

            return abort('404');

        endif;
    }

    public function delete(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_subcategories')):

            SubCategories::find($request->id)->delete();
            return redirect()->back();

        else:

            return abort('404');

        endif;   
    }

    public function getSubCategories(Request $request)
    {
        if($request->ajax()):
            $sub_category = SubCategories::where('categories_id', $request->id)->get();
            $product = Product::find($request->product);
            return response()->json(["sub" => $sub_category, "product" => $product->subcategories->pluck('id')]);
        else:
            return abort('404');
        endif;
    }

    public function getSubCategoriesAjax(Request $request)
    {
        if($request->ajax()):
            $sub_category = SubCategories::where('categories_id', $request->id)->get();
            return response()->json($sub_category);
        else:
            return abort('404');
        endif;
    }

}
