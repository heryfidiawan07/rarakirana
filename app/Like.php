<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','likeable_id','likeable_type','emoticon_id',];

    public function likeable(){
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
