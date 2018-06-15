<?php

namespace App\Http\Controllers;

use File;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except'=>['show','editProfil']]);
    }
    
    public function index()
    {
        $users = User::latest()->paginate(50);
        return view('admin.users.users',compact('users'));
    }

    public function status(Request $request, $id){
        $user = User::find($id);
        $user->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function banned(Request $request, $id){
        $user = User::find($id);
        $user->update([
                'status' => 2,
            ]);
        return back();
    }

    public function editProfil(Request $request, $id)
    {   
        $this->validate($request, [
                'name' => 'required',
                'img' => 'mimes:jpeg,bmp,png',
            ]);
        $user = User::whereId($id)->first();
        if ($user->name != $request->name) {
            $name = $request->name;
            $slug = str_slug($request->name);
            $cekslug = User::where('slug', $slug)->first();
            if (count($cekslug) > 0) {
                $slug = $slug.'-'.date("YmdHis");
            }
        }else{
            $name = $user->name;
            $slug = $user->slug;
        }
        $img  = $request->file('img');
        if (isset($img)) {
            $ex   = $img->getClientOriginalExtension();
            $imgN = $slug.'.'.$ex;
            $from = public_path("users/".$user->img);
            if (File::exists($from)) {
                File::delete($from);
            }
            $img->move("users/", $imgN);
        }else {
            $imgN = $user->img;
        }
        $user->update([
                'name' => $name,
                'slug' => $slug,
                'img' => $imgN,
            ]);
        return redirect("/user/{$user->slug}");
    }

    public function show($slug)
    {   
        $user = User::whereSlug($slug)->first();
        return view('users.index',compact('user'));
    }

    public function destroy($id)
    {
        //
    }
    
}
