<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Promo;
use App\Forum;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {		
    		$logo 	     = Logo::where('khusus', 111)->first();
    		$promos      = Promo::where([['home', 111],['status',1]])->get();
    		$newproducts = Product::where('status', 1)->latest()->paginate(4);
    		$newthreads  = Forum::where('status', 1)->latest()->paginate(4);
    		$hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
    		$hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        return view('home', compact('logo','promos','newproducts','newthreads','hothreads','hotproducts'));
    }
}
