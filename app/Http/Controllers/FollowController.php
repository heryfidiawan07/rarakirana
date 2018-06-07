<?php

namespace App\Http\Controllers;

use Auth;
use App\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {   
        $sosmed = ['facebook','twitter','google','pinterest','linkedin','whatsapp','instagram'];
        $follows = Follow::all();
        return view('admin.social.follow', compact('follows','sosmed'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'social' => 'required',
            ]);
        $user = Auth::user();
        Follow::create([
                'url' => $request->url,
                'class' => $request->social,
                'user_id' => $user->id,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $follow = Follow::find($id);
        $follow->delete();
        return back();
    }
    
}
