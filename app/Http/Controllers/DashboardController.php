<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    
    public function index()
    {   
    		$menus = Menu::all();
        return view('admin.dashboard',compact('menus'));
    }

}
