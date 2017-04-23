<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHasGalleries extends Model
{
    protected $table = "product_has_galleries";
    protected $primarykey = "id";

    protected $fillable = [
    	"product_id", "galleries_id", "set_utama"
    ];

}
