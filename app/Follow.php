<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['url','class','user_id',];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
