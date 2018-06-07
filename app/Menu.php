<?php

namespace App;

use App\User;
use App\Logo;
use App\Forum;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['menu', 'parent_id', 'url','user_id','contact','forum','parent_forum',];

    public function parent(){
    	return $this->hasMany('App\Menu', 'parent_id');
    }
    
    public function childs(){
    	return $this->belongsTo('App\Menu', 'parent_id');
    }

    public function childForum(){
        return $this->belongsTo('App\Menu', 'parent_forum');
    }

    public function parentForum(){
        return $this->hasMany('App\Menu', 'parent_forum');
    }

    public function contact(){
        return $this->belongsTo('App\Menu', 'contact');
    }

    public function forum(){
        return $this->belongsTo('App\Menu', 'forum');
    }
    
    public function forums(){
        return $this->hasMany(Forum::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function logos(){
        return $this->hasMany(Logo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
