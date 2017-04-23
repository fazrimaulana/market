<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    //
    protected $table = "sub_categories";
    protected $primarykey = "id";

    protected $fillable = [
    	'categories_id', 'name'
    ];

    public function categories()
    {
    	return $this->belongsTo('App\Categories', 'categories_id', 'id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product', 'product_has_sub_categories', 'sub_categories_id', 'product_id');
    }

}
