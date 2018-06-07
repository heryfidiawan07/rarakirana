<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use App\Logo;
use App\Menu;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $logos   = Logo::all();
        $menus   = Menu::has('logos','<',1)->get();
        $khusus1 = Logo::where('khusus',111)->get();
        $khusus2 = Logo::where('khusus',222)->get();
        return view('admin.logo.index', compact('logos','menus','khusus1','khusus2'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
                'img' => 'required',
            ]);
        $img  = $request->file('img');
        $user = Auth::user();
        if (!empty($img)) {
            if($request->menu_id){
                if($request->menu_id == 111){
                    $khusus  = 111;
                    $ex      = $img->getClientOriginalExtension();
                    $imgName = 'logo'.'.'.$ex;
                    $path    = $img->getRealPath();
                    $img     = Image::make($path)->resize(600, 315);
                    $logo    = Image::make($path)->resize(250, 150);
                    $img->save(public_path("part/". $imgName));
                    $logo->save(public_path("part/logo/". $imgName));
                    Logo::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'img' => $imgName,
                        'khusus' => $khusus,
                        'user_id' => $user->id,
                    ]);
                }else if ($request->menu_id == 222) {
                    $khusus  = 222;
                    $ex      = $img->getClientOriginalExtension();
                    $imgName = 'title-logo'.'.'.$ex;
                    $path    = $img->getRealPath();
                    $img     = Image::make($path)->resize(110, 64);
                    $img->save(public_path("part/". $imgName));
                    Logo::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'img' => $imgName,
                        'khusus' => $khusus,
                        'user_id' => $user->id,
                    ]);
                }else{
                    $menu    = Menu::whereId($request->menu_id)->first();
                    $ex      = $img->getClientOriginalExtension();
                    $imgName = $menu->url.'.'.$ex;
                    $path    = $img->getRealPath();
                    $img     = Image::make($path)->resize(600, 315);
                    $img->save(public_path("part/". $imgName));
                    $menuId = $request->menu_id;
                    Logo::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'menu_id' => $menuId,
                        'img' => $imgName,
                        'user_id' => $user->id,
                    ]);
                }
            }else{
                $request->session()->flash('status', 'Pilihan kategori gambar harus di pilih !');
                return back();
            }
            return redirect('/admin/logo');
        }
    }

    public function updateDesc(Request $request, $id)
    {
        $this->validate($request, [
                'titleEdit' => 'required',
                'descriptionEdit' => 'required',
            ]);
        $logo = Logo::whereId($id)->first();
            $logo->title = $request->titleEdit;
            $logo->description = $request->descriptionEdit;
            $logo->save();
        return back();
    }
    public function updateImg(Request $request, $id)
    {   
        $this->validate($request, [
                'logoEdit' => 'required',
            ]);
        $logo = Logo::whereId($id)->first();
        $img  = $request->file('logoEdit');
        if (empty($img)) {
            $imgName = $logo->img;
        }
        if (!empty($img)) {
            if ($logo->khusus == 111) {
                $cek1 = public_path("part/".$logo->img);
                $cek2 = public_path("part/logo/".$logo->img);
                File::delete($cek1);
                File::delete($cek2);
                $ex      = $img->getClientOriginalExtension();
                $imgName = 'logo'.'.'.$ex;
                $path    = $img->getRealPath();
                $img     = Image::make($path)->resize(600, 315);
                $logo    = Image::make($path)->resize(250, 100);
                $img->save(public_path("part/". $imgName));
                $logo->save(public_path("part/logo/". $imgName));
            }else if ($logo->khusus == 222) {
                $cek1 = public_path("part/".$logo->img);
                File::delete($cek1);
                $ex      = $img->getClientOriginalExtension();
                $imgName = 'title-logo'.'.'.$ex;
                $path    = $img->getRealPath();
                $img     = Image::make($path)->resize(110, 64);
                $img->save(public_path("part/". $imgName));
            }else{
                $cek1 = public_path("part/".$logo->img);
                File::delete($cek1);
                $menu    = Menu::whereId($logo->menu_id)->first();
                $ex      = $img->getClientOriginalExtension();
                $imgName = $menu->url.'.'.$ex;
                $path    = $img->getRealPath();
                $img     = Image::make($path)->resize(600, 315);
                $img->save(public_path("part/". $imgName));
            }
        }
        $user = Auth::user();
        $logo->img = $imgName;
        $logo->user_id = $user->id;
        $logo->save();
        return back();
    }

}
