<?php

namespace App;

use App\Menu;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $fillable = ['img', 'title', 'description', 'menu_id', 'khusus','user_id',];

    public function menu(){
    	return $this->belongsTo(Menu::class);
    }

    public function getMenu(){
    	return $this->menu;
    }

    public function getKhusus(){
        return $this->khusus;
    }
    
    public function khusus(){
    	if ($this->getMenu()) {
    		return $this->getMenu()->menu;
        }elseif ($this->getKhusus() == 111) {
            return 'Logo Utama';
        }elseif ($this->getKhusus() == 222) {
            return 'Logo Title';
    	}else{
    		return 'Logo Khusus';
    	}
    }
    
}
