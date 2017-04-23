<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHasSubCategories extends Model
{
    protected $table ="product_has_sub_categories";
    protected $primarykey = "id";

    protected $fillable = [
    	"product_id", "sub_categories_id"
    ];

}
