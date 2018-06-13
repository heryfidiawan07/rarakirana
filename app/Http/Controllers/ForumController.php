<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Logo;
use App\Promo;
use App\Menu;
use App\Forum;
use App\Comment;
use App\Like;
use App\Product;
use Illuminate\Http\Request;

class ForumController extends Controller
{   
    public function __construct()
    {
        $this->middleware('admin', ['except'=>['create','store','edit','update','show','menu','kategori']]);
    }

    public function menu(Request $request, $menu){
        $menu = Menu::where([['url',$menu],['forum',1]])->first();
        $threads = Forum::latest()->paginate(10);
        //Tambahan
        $logo        = Logo::where('menu_id', $menu->id)->first();
        $promos      = Promo::where([['menu_id', $menu->id],['status',1]])->get();
        $newproducts = Product::where('status', 1)->latest()->paginate(4);
        $newthreads  = Forum::where('status', 1)->latest()->paginate(4);
        $hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $categorys   = Menu::where('parent_id',$menu->id)->get();
        //End
        $request->session()->flash('status', 'Forum belum memiliki threads.');
        return view('forum.index', compact('threads','logo','promos','newproducts','newthreads','hotproducts','hothreads','categorys','menu'));
    }
    
    public function kategori(Request $request, $menu){
        $menu        = Menu::where('url',$menu)->first();
        $menuForum   = Menu::where('forum',1)->first();
        $threads     = Forum::where('menu_id',$menu->id)->paginate(10);
        //Tambahan
        $logo        = Logo::where('menu_id', $menu->id)->first();
        $promos      = Promo::where([['menu_id', $menu->id],['status',1]])->get();
        $newproducts = Product::where('status', 1)->latest()->paginate(4);
        $newthreads  = Forum::where('status', 1)->latest()->paginate(4);
        $hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $categorys   = Menu::where('parent_id',$menuForum->id)->get();
        //End
        $request->session()->flash('status', 'Kategori ini belum memiliki threads.');
        return view('forum.index', compact('threads','logo','promos','newproducts','newthreads','hotproducts','hothreads','categorys','menu'));
    }
    
    
    public function index()
    {   
        $forum   = Menu::where('forum',1)->first();
        $parents = Menu::has('parentForum')->get();
        if ($forum) {
            $categorys = Menu::where('parent_id',$forum->id)->get();
            $induxs = Menu::has('forums','<',1)->has('childForum','<',1)->where('parent_id',$forum->id)->get();
        }else{
            $categorys = "";
            $induxs    = "";
        }
        return view('admin.forum.index',compact('categorys','forum','induxs','parents'));
    }

    public function threads()
    {   
        $forum   = Menu::where('forum',1)->first();
        $threads  = Forum::latest()->paginate(20);
        return view('admin.forum.threads',compact('threads','forum'));
    }

    public function tambahKategori(Request $request){
        $this->validate($request, [
                'category' => 'required|max:50',
                'parent_forum' => 'required',
            ]);
        $url = str_slug($request->category);
        $user = Auth::user();
        $forumId = Menu::where('forum',1)->first();
        Menu::create([
                'menu' => $request->category,
                'parent_id' => $forumId->id,
                'url' => $url,
                'user_id' => $user->id,
                'parent_forum' => $request->parent_forum,
            ]);
        return redirect('admin/forum');
    }
    
    public function editKategori(Request $request, $id)
    {
        $this->validate($request, [
                'category' => 'required|max:50',
                'parent_forum' => 'required',
            ]);
        $url = str_slug($request->category);
        $user = Auth::user();
        $forumId = Menu::where('forum',1)->first();
        $menu = Menu::whereId($id)->first();
        $menu->update([
                'menu' => $request->category,
                'url' => $url,
                'user_id' => $user->id,
                'parent_forum' => $request->parent_forum,
            ]);
        return redirect('admin/forum');
    }

    public function threadStatus(Request $request, $id){
        $thread = Forum::whereId($id)->first();
        $thread->update([
                'status' => $request->status,
            ]);
        return redirect('admin/threads');
    }
    
    public function create(){
        $forum  = Menu::where('forum',1)->first();
        $threadMenus = Menu::has('parentForum','<',1)->where('parent_id',$forum->id)->get();
        return view('forum.create',compact('threadMenus'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3|unique:forums',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $user = Auth::user();
        $uniq = date("YmdHis");
        $forum = Forum::create([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'slug' => str_slug($request->title).'-'.$uniq,
            'uniq' => $uniq,
            'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
            'user_id' => $user->id,
            'status' => 1,
        ]);
        return redirect("/category/{$forum->menu->url}/{$forum->slug}");
    }

    public function show($menuslug, $forumSlug)
    {
        $menu     = Menu::where('url',$menuslug)->first();
        $parent   = Menu::where('forum',1)->first();
        $thread   = Forum::whereSlug($forumSlug)->first();
        //===========
        $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $hothreads  = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
        $newproducts = Product::where('status', 1)->latest()->paginate(4);
        $newthreads  = Forum::where('status', 1)->latest()->paginate(4);

        if ($menu) {
            $logo   = Logo::where('menu_id', $menu->id)->first();
            $promos = Promo::where([['menu_id', $menu->id],['status',1]])->get();
            if ($thread) {
                $comments = $thread->comments()->orderBy('created_at')->paginate(10);
                return view('forum.show',compact('thread','logo','promos','comments','commentos','parent','hotproducts','hothreads','newproducts','newthreads'));
            }else{
                return view('errors.503');    
            }
        }else{
            return view('errors.503');
        }
        
    }

    public function edit($id)
    {   
        $thread      = Forum::whereId($id)->first();
        $forum       = Menu::where('forum',1)->first();
        $threadMenus = Menu::where('parent_id',$forum->id)->get();
        return view('forum.edit',compact('threadMenus','thread'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $thread = Forum::whereId($id)->first();
        $user   = Auth::user();
        $uniq   = $thread->uniq;
        $thread->update([
            'menu_id' => $request->menu_id,
            'title' => $request->title,
            'slug' => str_slug($request->title).'-'.$uniq,
            'uniq' => $uniq,
            'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
            'user_id' => $user->id,
        ]);
        return redirect("/category/{$thread->menu->url}/{$thread->slug}");
    }

    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return back();
    }

    public function threadDestroy($id)
    {
        $thread = Forum::find($id);
        $comment = Comment::where([['commentable_id',$thread->id],['commentable_type','App\Forum']])->get();
        foreach ($comment as $comlike) {
            $comlike->likes()->delete();
        }
        $thread->comments()->delete();
        $thread->likes()->delete();
        $thread->delete();
        return back();
    }
    
}
