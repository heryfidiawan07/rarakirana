<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function product(Request $request, $id)
    {
        $this->validate($request, [
                'description' => 'required|max:1000|min:2',
            ]);
        $user = Auth::user();
        $comment = Comment::create([
                'user_id' => $user->id,
                'description' => Purifier::clean($request->description),
                'commentable_id' => $id,
                'commentable_type' => 'App\Product',
            ]);
        return back();
    }

    public function productUpdate(Request $request, $id)
    {   
        $comment = Comment::find($id);
        $user = Auth::user();
        $comment->update([
                'description' => Purifier::clean($request->description),
            ]);
        //$request->session()->flash('status', 'Pesan anda berhasil dikirim.');
        return response()->json($comment);
        //return response()->json(array('sales' => $sales, 'link' => $link));
    }

    public function forum(Request $request, $id)
    {   
        $this->validate($request, [
                'description' => 'required|max:1000|min:2',
            ]);
        $user = Auth::user();
        $comment = Comment::create([
                'user_id' => $user->id,
                'description' => Purifier::clean($request->description),
                'commentable_id' => $id,
                'commentable_type' => 'App\Forum',
            ]);
        return back();
    }

    public function forumUpdate(Request $request, $id)
    {   
        $comment = Comment::find($id);
        $user = Auth::user();
        $comment->update([
                'description' => Purifier::clean($request->description),
            ]);
        //$request->session()->flash('status', 'Pesan anda berhasil dikirim.');
        return response()->json($comment);
        //return response()->json(array('sales' => $sales, 'link' => $link));
    }

    public function destroy($id)
    {
        //
    }
    
}
