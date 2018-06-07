<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Like;
use App\Product;
use App\Comment;
use App\Emoticon;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function productlike(Request $request, $lid, $pid)
    {   
        $user   = Auth::user();
        $userId = $user->id;
        $like   = Like::where([['user_id',$userId],['likeable_id',$pid],['likeable_type','App\Product']])->first();
        if (count($like) == 0){
            Like::create([
               'user_id' => $userId,
               'likeable_id' => $pid,//Product / Parameter yang di like
               'likeable_type' => 'App\Product',
               'emoticon_id' => $lid,
            ]);
        }else {
            if($like->emoticon_id == $lid){
                $like->delete();
            }else{
                $like->update([
                  'emoticon_id' => $lid,
                ]);
            }
        }
        return back();
    }

    public function threadlike(Request $request, $lid, $fid)
    {   
        $user   = Auth::user();
        $userId = $user->id;
        $like   = Like::where([['user_id',$userId],['likeable_id',$fid],['likeable_type','App\Forum']])->first();
        if (count($like) == 0){
            Like::create([
               'user_id' => $userId,
               'likeable_id' => $fid,//Forum id
               'likeable_type' => 'App\Forum',
               'emoticon_id' => $lid,
            ]);
        }else {
            if($like->emoticon_id == $lid){
                $like->delete();
            }else{
                $like->update([
                  'emoticon_id' => $lid,
                ]);
            }
        }
        return back();
    }

    public function commentlike(Request $request, $id)
    {
        $user = Auth::user();
        $like = Like::where([['user_id',$user->id],['likeable_id',$id],['likeable_type','App\Comment']])->first();
        if (count($like) == 0){
            if (Auth::user()) {
                Like::create([
                   'user_id' => $user->id,
                   'likeable_id' => $id,//Komentar yang di like
                   'likeable_type' => 'App\Comment',
                   'emoticon_id' => 1,// Emoticon harus ada
                ]);
            }
            $status = '+1';
        }else {
            $like->delete();
            $status = '-1';
        }
        $prnlike = Comment::whereId($id)->first();
        return response()->json(array('prnlike' => $prnlike->likes, 'status' => $status));
    }

    public function getUserLike($id){
        $likes = Like::where([['likeable_type','App\Comment'],['likeable_id',$id]])->get();
        $users = DB::table('users')
                ->join('likes', 'likes.user_id', '=', 'users.id')
                ->where([['likes.likeable_type','App\Comment'],['likes.likeable_id',$id]])
                ->get();
        return response()->json(array('users'=>$users,'likes'=>$likes));
    }

    public function getUserProductVote($mid, $pid){//Melihat siapa yang vote pada product
        $likes = Like::where([['likeable_type','App\Product'],['likeable_id',$pid],['emoticon_id',$mid]])->get();
        $users = DB::table('users')
                ->join('likes', 'likes.user_id', '=', 'users.id')
                ->where([['likes.likeable_type','App\Product'],['likes.likeable_id',$pid],['emoticon_id',$mid]])
                ->get();
        return response()->json(array('users'=>$users,'likes'=>$likes));   
    }
    
    public function getUserThreadVote($mid, $fid){//Melihat siapa yang vote pada thread
        $likes = Like::where([['likeable_type','App\Forum'],['likeable_id',$fid],['emoticon_id',$mid]])->get();
        $users = DB::table('users')
                ->join('likes', 'likes.user_id', '=', 'users.id')
                ->where([['likes.likeable_type','App\Forum'],['likes.likeable_id',$fid],['emoticon_id',$mid]])
                ->get();
        return response()->json(array('users'=>$users,'likes'=>$likes));   
    }
    
}
