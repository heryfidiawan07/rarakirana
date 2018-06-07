<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['commentable_id','commentable_type','user_id','description','status',];

    public function commentable(){
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->morphMany('App\Like','likeable');
    }
    
}
