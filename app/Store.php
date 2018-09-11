<?php

namespace App;

use App\User;
use App\Menu;
use App\Display;
use App\Discusion;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['user_id','title','slug','uniq','description','menu_id','status',];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function discusions(){
    	return $this->hasMany(Discusion::class);
    }

    public function displays(){
    	return $this->hasMany(Display::class);
    }
    
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->morphMany('App\Like','likeable');
    }

}
