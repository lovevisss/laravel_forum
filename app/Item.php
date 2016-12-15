<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Item extends Model{
	public static function getAll(){
		return 'device name is sean';
	}

	protected $table = 'item';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'seller','price','desc','picture','zan'];


	public function author()
	{
		return $this->belongsTo('App\User','seller');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment','itemid');
	}
}