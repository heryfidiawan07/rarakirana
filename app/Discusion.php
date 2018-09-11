<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Discusion extends Model
{
    protected $fillable = ['user_id','store_id','description','status',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->morphMany('App\Like','likeable');
    }

}
