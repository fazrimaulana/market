<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primarykey = "id";

    protected $fillable = [
    	'user_id', 'name', 'price', 'amount', 'stock', 'condition', 'categories_id', 'description'
    ];

    public function subcategories()
    {
    	return $this->belongsToMany('App\SubCategories', 'product_has_sub_categories', 'product_id', 'sub_categories_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Categories', 'categories_id', 'id');
    }

    public function gallery()
    {
        return $this->belongsToMany('App\Gallery', 'product_has_galleries', 'product_id', 'galleries_id')->withPivot('set_utama');
    }

    public function set_utama()
    {
        return $this->belongsToMany('App\Gallery', 'product_has_galleries', 'product_id', 'galleries_id')->wherePivot('set_utama', 1);
    }

    public function gallery_other()
    {
        return $this->belongsToMany('App\Gallery', 'product_has_galleries', 'product_id', 'galleries_id')->wherePivot('set_utama', 0);
    }

}
