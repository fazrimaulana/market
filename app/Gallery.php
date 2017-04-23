<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "galleries";
    protected $primarykey = "id";

    protected $fillable = [
    	"name", "extension", "path",
    ];

    public function product()
    {
        return $this->belongsToMany('App\Product', 'product_has_galleries', 'galleries_id', 'product_id')->withPivot('set_utama');
    }

}
