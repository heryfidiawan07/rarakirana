<?php

namespace App\Http\Controllers;

use File;
use App\Product;
use App\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function destroy($id)
    {
        $picture = Picture::whereId($id)->first();
        $img     = public_path("picture/img/".$picture->img);
        $thumb   = public_path("picture/thumb/".$picture->thumb);
        if (file_exists($img)) {
            File::delete($img);
            File::delete($thumb);
            $picture->delete();
        }else {
            return back();
        }
        return back();
    }
    
}
