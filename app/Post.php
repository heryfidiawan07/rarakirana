<?php

namespace App;

use App\User;
use App\Menu;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['thumb', 'img', 'title', 'slug', 'description', 'status', 'menu_id','user_id','comment_status',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }
    
}
