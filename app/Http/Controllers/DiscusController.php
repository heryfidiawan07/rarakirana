<?php

namespace App\Http\Controllers;

use Auth;
use App\Store;
use App\Discusion;
use Illuminate\Http\Request;

class DiscusController extends Controller
{
    
    public function store(Request $request, $id)
    {
        $store = Store::whereId($id)->first();
        if ($store) {
            $discus = Discusion::create([
                    'user_id' => Auth::user()->id,
                    'store_id' => $store->id,
                    'description' => $request->description,
                ]);
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $comment = Discusion::find($id);
        $user = Auth::user();
        $comment->update([
                'description' => Purifier::clean($request->description),
            ]);
        //$request->session()->flash('status', 'Pesan anda berhasil dikirim.');
        return response()->json($comment);
        //return response()->json(array('sales' => $sales, 'link' => $link));
    }

}
