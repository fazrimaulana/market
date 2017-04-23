<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = "categories";
    protected $primarykey = "id";

    protected $fillable = [
    	'name'
    ];

    public function subcategories()
    {
    	return $this->hasMany('App\SubCategories', 'categories_id', 'id');
    }

    public function product()
    {
        return $this->hasOne('App\Product', 'categories_id', 'id');
    }

}
