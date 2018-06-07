<?php

namespace App;

use App\Like;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Emoticon extends Model
{
    protected $fillable = ['emoji','user_id',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function like(){
    	return $this->belongsTo(Like::class);
    }
    
}
