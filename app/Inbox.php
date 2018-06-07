<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    protected $fillable = ['email','user_id','description','ip',];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
    public function getName(){
    	return $this->user;
    }

    public function getUser(){
    	if ($this->getName()) {
    		return $this->getName()->name;
    	}else{
    		return 'Tidak Login';
    	}
    }
}
