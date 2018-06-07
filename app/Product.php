<?php

namespace App;

use App\User;
use App\Menu;
use App\Picture;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'slug', 'uniq', 'description', 'status', 'menu_id','user_id','comment_status',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function pictures(){
    	return $this->hasMany(Picture::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }

    public function likes(){
        return $this->morphMany('App\Like','likeable');
    }
    
}
