<?php

namespace App\Http\Controllers;

use Auth;
use App\Emoticon;
use Illuminate\Http\Request;

class EmoticonController extends Controller
{   
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        $emoticons = ['like','love','haha','wow','yay','sad','angry'];
        $emojis = Emoticon::all();
        return view('admin.emoticon.index', compact('emoticons','emojis'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'emoji' => 'required',
            ]);
        $user = Auth::user();
        Emoticon::create([
                'emoji' => $request->emoji,
                'user_id' => $user->id,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $emoji = Emoticon::find($id);
        $emoji->delete();
        return back();
    }
    
}
