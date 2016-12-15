<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
 

    protected $table = 'comment';
    protected $primaryKey = 'id';
    protected $fillable = ['comment', 'reply_to_uid','uid','itemid','zan'];


    public function item()
    {
        return $this->belongsTo('App\Item','itemid');
    }
}