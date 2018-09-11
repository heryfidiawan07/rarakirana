<?php

namespace App\Http\Controllers;

use File;
use App\Store;
use App\Display;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function destroy($id)
    {
        $display = Display::whereId($id)->first();
        $img     = public_path("store/img/".$display->img);
        $thumb   = public_path("store/thumb/".$display->thumb);
        if (file_exists($img)) {
            File::delete($img);
            File::delete($thumb);
            $display->delete();
        }else {
            return back();
        }
        return back();
    }
}
