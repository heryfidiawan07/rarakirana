<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['thumb', 'img', 'product_id',];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
    
}
