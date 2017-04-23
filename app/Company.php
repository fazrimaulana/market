<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company";
    protected $primarykey = "id";

    protected $fillable = [
    	"user_id", "name", "alamat", "telepon", "no_hp"
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
