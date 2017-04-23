<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Gallery;
use File;
use Auth;
use App\ProductHasGalleries;

class GalleryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {   
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_see_module_galleries')):

           $galleries = Gallery::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('backend.galleries.index',[
                "galleries" => $galleries
            ]);

        else:

            return abort('404');

        endif;
    }

    public function add()
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_galleries')):

           return view('backend.galleries.add');

        else:

            return abort('404');

        endif;
    }

    public function store(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_add_galleries')):

           $this->validate($request,[
                "file" => "image"
            ]);

            $nama      = date("YmdHis")."-".str_slug(pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            $extension = $request->file('file')->getClientOriginalExtension();
            $fullname  = $nama . "." . $extension;
            $path      = "images";

            $request->file('file')->move($path, $fullname);

            $gallery = new Gallery();

            $gallery->user_id = Auth::user()->id;
            $gallery->name = $nama;
            $gallery->extension = $extension;
            $gallery->path = $path ."/". $fullname;

            $gallery->save();

            return response()->json($gallery->id);

        else:

            return abort('404');

        endif;

    }

    public function update(Request $request)
    {

        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_edit_galleries')):

           $this->validate($request,[
                "file" => "required|image"
            ]);

            $nama      = date("YmdHis")."-".str_slug(pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME), '-');
            $extension = $request->file('file')->getClientOriginalExtension();
            $fullname  = $nama . "." . $extension;
            $path      = "images";

            $request->file('file')->move($path, $fullname);

            $gallery = Gallery::find($request->id);

            File::delete($gallery->path);

            $gallery->user_id = Auth::user()->id;
            $gallery->name = $nama;
            $gallery->extension = $extension;
            $gallery->path = $path ."/". $fullname;

            $gallery->save();

            return redirect()->back();

        else:

            return abort('404');

        endif;

    }

    public function delete(Request $request)
    {
        if(Auth::user()->hasRole('Root') || Auth::user()->can('can_delete_galleries')):

            if($request->ajax())
            {
                $gallery = Gallery::find($request->id);

                File::delete($gallery->path);

                $gallery->delete();

                return response()->json($request->id);

            }

            $gallery = Gallery::find($request->id);

            File::delete($gallery->path);

            $gallery->delete();

            return redirect()->back();

        else:

            return abort('404');

        endif;
    }

    public function setUtama(Request $request)
    {
            if($request->ajax()){
                return response()->json($request->id);
            }
            else{
                return abort('404');
            }

    }
}
