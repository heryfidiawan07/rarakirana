<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Menu;
use App\Post;
use App\Promo;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postMenus = Menu::has('products','<',1)->has('parent','<',1)->get();
        return view('admin.post.create', compact('postMenus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
                'title' => 'required|max:255|min:3|unique:posts',
                'img' => 'required',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $titleSlug = str_slug($request->title);
        $img = $request->file('img');
        
        if(!isset($_POST['status'])){
            $status = 1;
        }else{
            $status = $request->status;
        }

        if (empty($img)) {
            $request->session()->flash('status', 'File gambar yang harus di isi !');
            return back();
        }else{
            $ex      = $img->getClientOriginalExtension();
            $imgName = strtolower(str_random(20)).'.'.$ex;
            $path    = $img->getRealPath();
            $img     = Image::make($path)->resize(600, 315);
            $img->save(public_path("post/img/". $imgName));
            $thumb   = Image::make($path)->resize(200, 120);
            $thumb->save(public_path("post/thumb/". $imgName));
            $user = Auth::user();
            Post::create([
                'menu_id' => $request->menu_id,
                'thumb' => $imgName,
                'img' => $imgName,
                'title' => $request->title,
                'slug' => $titleSlug,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $status,
                'user_id' => $user->id,
                'comment_status' => 0,
            ]);
            return redirect('/admin/post');
        }
    }

    public function status(Request $request, $id){
        $post = Post::find($id);
        $post->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function commentStatus(Request $request, $id){
        $post = Post::find($id);
        $post->update([
                'comment_status' => $request->status,
            ]);
        return back();
    }
    
    public function preview($id){
        $post   = Post::whereId($id)->first();
        $promos = Promo::where([['menu_id', $post->menu_id],['status', 1]])->get();
        $comments = $post->comments()->orderBy('created_at','desc')->paginate(10);
        if ($post) {
            return view('admin.post.preview', compact('post','promos','comments'));
        }else{
            return view('errors.503');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $post   = Post::where([['slug', $slug],['status', 1]])->first();
        $promos = Promo::where([['menu_id', $post->menu_id],['status', 1]])->get();
        $comments = $post->comments()->orderBy('created_at')->latest()->paginate(10);
        if ($post) {
            return view('post.show', compact('post','promos','comments'));
        }else{
            return view('errors.503');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::whereId($id)->first();
        $postMenus = Menu::has('products','<',1)->has('parent','<',1)->get();
        return view('admin.post.edit', compact('post','postMenus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $post = Post::whereId($id)->first();
        $titleSlug = str_slug($request->title);
        $img = $request->file('img');
        if (empty($img)) {
            $imgName = $post->img;
        }else {
            $cek1 = public_path("post/img/".$post->img);
            $cek2 = public_path("post/thumb/".$post->img);
            File::delete($cek1);
            File::delete($cek2);
            $ex      = $img->getClientOriginalExtension();
            $imgName = strtolower(str_random(20)).'.'.$ex;
            $path    = $img->getRealPath();
            $img     = Image::make($path)->resize(600, 315);
            $img->save(public_path("post/img/". $imgName));
            $thumb   = Image::make($path)->resize(200, 120);
            $thumb->save(public_path("post/thumb/". $imgName));
        }

        if(!isset($_POST['status'])){
            $status = $post->status;
        }else{
            $status = $request->status;
        }
        $user = Auth::user();
        $post->update([
            'menu_id' => $request->menu_id,
            'thumb' => $imgName,
            'img' => $imgName,
            'title' => $request->title,
            'slug' => $titleSlug,
            'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
            'status' => $status,
            'user_id' => $user->id,
            'comment_status' => $post->comment_status,
        ]);
        return redirect('/admin/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $post = Post::find($id);
        $cek1 = public_path("post/img/".$post->img);
        $cek2 = public_path("post/thumb/".$post->img);
        File::delete($cek1);
        File::delete($cek2);
        $post->delete();
        return back();
    }
}
