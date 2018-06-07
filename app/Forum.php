<?php

namespace App;

use App\User;
use App\Menu;
use App\Like;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['user_id','menu_id','title','slug','uniq','description','status',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    public function likes(){
        return $this->morphMany('App\Like','likeable');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
