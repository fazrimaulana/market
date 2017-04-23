<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Categories;
use Auth;
use App\Gallery;
use App\ProductHasGalleries;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_product')):

            $products = Product::where('user_id', Auth::user()->id)->paginate(10);

            return view('backend.product.index', [
                "products" => $products
            ]);

        else:

            return abort('404');

        endif;

    }

    public function add()
    {   
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_product')):

    	    $categories = Categories::all();
    	    return view('backend.product.add',[
    			"categories" => $categories
    		]);

        else:

            return abort('404');

        endif;

    }

    public function store(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_product')):

            $this->validate($request, [
                "name" => "required",
                "price" => "required|integer",
                "amount" => "required|integer",
                "condition" => "required",
                "category" => "required",
                "sub_categories" => "required"
            ]);

        

            $product = new Product;
            $product->user_id = Auth::user()->id;
            $product->name    = $request->name;
            $product->price   = $request->price;
            $product->amount  = $request->amount;
            $product->stock   = $request->amount;
            $product->condition = $request->condition;
            $product->categories_id = $request->category;
            $product->description = $request->description;

            $product->save();

            $product->subcategories()->attach($request->sub_categories);

            if ($request->gallery) {
                $product->gallery()->attach($request->gallery);   
            }   

            if($request->set_utama!="0")
            {
                ProductHasGalleries::where('product_id', $product->id)->where('galleries_id', $request->set_utama)->update([
                    "set_utama" => "1"
                ]);
            }

            return redirect('/dashboard/product');

        else:

            return abort('404');

        endif;


    }

    public function getData(Product $product)
    {   
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_product')):

            $categories = Categories::all();
            return view('backend.product.edit', [
                "product" => $product,
                "categories" => $categories
            ]);

        else:

            return abort('404');

        endif;

    }

    public function update(Request $request, Product $product)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_product')):

            $this->validate($request, [
                "name" => "required",
                "price" => "required|integer",
                "amount" => "required|integer",
                "condition" => "required",
                "category" => "required",
                "sub_categories" => "required"
            ]);

            $product->user_id = Auth::user()->id;
            $product->name    = $request->name;
            $product->price   = $request->price;
            $product->amount  = $request->amount;
            $product->stock   = $request->amount;
            $product->condition = $request->condition;
            $product->categories_id = $request->category;
            $product->description = $request->description;

            $product->save();

            $product->subcategories()->sync($request->sub_categories);

            if ($request->gallery) {
                $product->gallery()->attach($request->gallery);   
            }

            if($request->set_utama!="0")
            {

                $updateNull = ProductHasGalleries::where('product_id', $product->id)->where('set_utama', '1')->first();
                if ($updateNull!=null) {
                    $updateNull->update([
                        "set_utama" => 0
                    ]);
                }

                ProductHasGalleries::where('product_id', $product->id)->where('galleries_id', $request->set_utama)->update([
                    "set_utama" => "1"
                ]);

            }

            return redirect('/dashboard/product');

        else:

            return abort('404');

        endif;
        
    }

    public function delete(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_product')):

            Product::find($request->id)->delete();
            return redirect()->back();

        else:

            return abort('404');

        endif;
        
    }

    public function deleteGallery(Request $request)
    {
        ProductHasGalleries::where('product_id', $request->id_product)->where('galleries_id', $request->id_gallery)->delete();

        return redirect()->back();

    }

    public function edit_set_utama(Request $request)
    {
        $updateNull = ProductHasGalleries::where('product_id', $request->p_id)->where('set_utama', '1')->first();

        if ($updateNull!=null) {
            $updateNull->update([
                    "set_utama" => 0
                ]);
        }

        ProductHasGalleries::where('product_id', $request->p_id)->where('galleries_id', $request->g_id)->update([
                "set_utama" => 1
            ]);

        return redirect('/dashboard/product/'.$request->p_id.'/edit');

    }

    public function view(Product $product)
    {
        return view('backend.product.view',[
                "product" => $product
            ]);

    }


}
