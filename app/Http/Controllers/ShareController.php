<?php

namespace App\Http\Controllers;

use Auth;
use App\Share;
use Illuminate\Http\Request;

class ShareController extends Controller
{   
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {   
        $sosmed = ['facebook','twitter','google','pinterest','linkedin','whatsapp'];
        $shares = Share::all();
        return view('admin.social.share', compact('shares','sosmed'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'social' => 'required',
            ]);
        $sosmed = ['facebook','twitter','google','pinterest','linkedin','whatsapp'];
        $shareUrl = [
            "https://www.facebook.com/sharer/sharer.php?u=Request::url()",
            "https://twitter.com/share?url=Request::url()",
            "https://plus.google.com/share?url=Request::url()",
            "https://pinterest.com/pin/create/button/?url=Request::url()",
            "https://www.linkedin.com/shareArticle?url=true&url=Request::url()",
            "whatsapp://send?text=Request::url()"
        ];
        for ($i=0; $i < count($sosmed); $i++) { 
            if ($request->social === $sosmed[$i]) {
                $url = $shareUrl[$i];
            }
        }
        $user = Auth::user();
        Share::create([
                'url' => $url,
                'class' => $request->social,
                'user_id' => $user->id,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $share = Share::find($id);
        $share->delete();
        return back();
    }
    
}
