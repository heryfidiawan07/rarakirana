<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Image;
use App\Menu;
use App\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {   
        $promosi    = Promo::has('menu')->select('*')->get()->groupBy('menu_id');
        $homePromo  = Promo::whereHome('111')->get();
        $promoMenus = Menu::all();
        return view('admin.promo.index', compact('promoMenus','promosi','homePromo'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'menu_id' => 'required',
                'img' => 'required',
            ]);
        if(!isset($_POST['color'])){
            $request->color = '#ffffff';
        }
        if(!isset($_POST['status'])){
            $status = 1;
        }else{
            $status = $request->status;
        }
        $user    = Auth::user();
        $img     = $request->file('img');
        $ex      = $img->getClientOriginalExtension();
        $imgName = strtolower(str_random(20)).'.'.$ex;
        $request->file('img')->move("promo/", $imgName);
        if ($request->menu_id == 111) {
            Promo::create([
                'home' => $request->menu_id,
                'img' => $imgName,
                'status' => $status,
                'color' => $request->color,
                'user_id' => $user->id,
            ]);   
        }else{
            Promo::create([
                'menu_id' => $request->menu_id,
                'img' => $imgName,
                'status' => $status,
                'color' => $request->color,
                'user_id' => $user->id,
            ]);   
        }
        return back();
    }

    public function preview($id)
    {   
        if ($id == 111) {
            $promos = Promo::where('home',$id)->get();
            return view('admin.promo.preview', compact('promos'));
        }else {
            $promos = Promo::where('menu_id',$id)->get();
            return view('admin.promo.preview', compact('promos'));
        }
    }

    public function edit($id)
    {
        $promo      = Promo::whereId($id)->first();
        $promoMenus = Menu::all();
        return view('admin.promo.edit', compact('promo','promoMenus'));
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::whereId($id)->first();
        if(!isset($_POST['img'])){
            $imgName = $promo->img;
        }
        if(!isset($_POST['color'])){
            $request->color = $promo->color;
        }
        if(!isset($_POST['status'])){
            $status = $promo->status;
        }else{
            $status = $request->status;
        }
        if (!isset($_POST['menu_id'])){
            if ($promo->menu_id == null) {
                $request->menu_id = $promo->home;
            }else{
                $request->menu_id = $promo->menu_id;
            }
        }
        $img = $request->file('img');
        if (!empty($img)) {
            $cekImg = public_path("promo/".$promo->img);
            File::delete($cekImg);
            $ex      = $img->getClientOriginalExtension();
            $imgName = strtolower(str_random(20)).'.'.$ex;
            $path    = $img->getRealPath();
            $img     = Image::make($path)->resize(null, 200);
            $img->save(public_path("promo/". $imgName));
        }
        if ($request->menu_id == 111) {
            $user = Auth::user();
            $promo->update([
                'home' => $request->menu_id,
                'img' => $imgName,
                'status' => $status,
                'color' => $request->color,
                'user_id' => $user->id,
            ]);   
        }else{
            $user = Auth::user();
            $promo->update([
                'menu_id' => $request->menu_id,
                'img' => $imgName,
                'status' => $status,
                'home' => null,
                'color' => $request->color,
                'user_id' => $user->id,
            ]);   
        }
        return redirect('/admin/promo');
    }

    public function status(Request $request, $id){
        $promo = Promo::find($id);
        $user = Auth::user();
        $promo->update([
                'status' => $request->status,
                'user_id' => $user->id,
            ]);
        return back();
    }

}
