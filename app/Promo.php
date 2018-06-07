<?php

namespace App;

use App\Menu;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = ['img', 'menu_id', 'home', 'status', 'color','user_id',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getMenu(){
    	return $this->menu;
    }
    
    public function khusus(){
    	if ($this->getMenu()) {
    		return $this->getMenu()->menu;
    	}else{
    		return 'Halaman Home';
    	}
    }

    public function khususId(){
        if ($this->getMenu()) {
            return $this->getMenu()->id;
        }else{
            return 111;
        }
    }

}
