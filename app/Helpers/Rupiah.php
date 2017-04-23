<?php

namespace App\Helpers;

/**
* 
*/
class Rupiah
{
	public static function rupiah($number)
	{
		$angka = "Rp ". number_format($number,2,',','.');
		return $angka; 
	}
}