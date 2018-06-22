<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {   
        $detect  = Menu::has('forum')->first();
        if ($detect) {
            $menus   = Menu::where('parent_id','!=',$detect->id)->latest()->get();
        }else{
            $menus   = Menu::latest()->get();
        }
        $parents = Menu::has('parent')->get();
        $induxs  = Menu::has('products','<',1)->has('childs','<',1)->has('forum','<',1)->where('contact','!=',1)->get();
        $forum   = Menu::where('forum',1)->first();
        return view('admin.menu.index', compact('menus','induxs','parents','forum'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'menu' => 'required|unique:menus|max:50',
            ]);
        $url = str_slug($request->menu);
        $user = Auth::user();
        
        if(isset($_POST['forcont'])){
            if ($_POST['forcont'] == 'contact') {
                $contact = 1;
                $forum = 0;
            }else if ($_POST['forcont'] == 'setelan') {
                $contact = 0;
                $forum = 0;
            }else{
                $contact = 0;
                $forum = 1;
            }
        }else{
            $contact = 0;
            $forum = 0;
        }
        if(!isset($_POST['parent_id'])){
            $parent_id = 0;
        }else{
            $parent_id = $request->parent_id;
        }

        Menu::create([
                'menu' => $request->menu,
                'parent_id' => $parent_id,
                'url' => $url,
                'user_id' => $user->id,
                'contact' => $contact,
                'forum' => $forum,
            ]);
        return redirect('admin/menu');
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
                'menu' => 'required|max:50',
            ]);

        $menu = Menu::whereId($id)->first();
        $url = str_slug($request->menu);
        $user = Auth::user();
        if(isset($_POST['forcont'])){
            if ($_POST['forcont'] == 'contact') {
                $contact = 1;
                $forum = 0;
            }else if ($_POST['forcont'] == 'setelan') {
                $contact = 0;
                $forum = 0;
            }else{
                $contact = 0;
                $forum = 1;
            }
        }else{
            $contact = $menu->contact;
            $forum = $menu->forum;
        }
        if(!isset($_POST['parent_id'])){
            $parent_id = 0;
        }else{
            $parent_id = $request->parent_id;
        }
        $menu->update([
                'menu' => $request->menu,
                'parent_id' => $parent_id,
                'url' => $url,
                'user_id' => $user->id,
                'contact' => $contact,
                'forum' => $forum,
            ]);
        return back();
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return back();
    }

}
