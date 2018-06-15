<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Image;
use Purifier;
use App\Logo;
use App\Menu;
use App\User;
use App\Like;
use App\Promo;
use App\Forum;
use App\Picture;
use App\Product;
use App\Comment;
use App\Emoticon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except'=>'show']);
    }

    public function index()
    {   
        $menus    = Menu::all();
        $products = Product::latest()->paginate(8);
        return view('admin.product.index', compact('products','menus'));
    }

    public function create()
    {   
        $forum = Menu::where('forum',1)->first();//Error jika menu forum belum di tentukan
        if ($forum) {
            $menus = Menu::has('contact','<',1)->has('parent','<',1)->where([['parent_id','!=',$forum->id],['forum','!=',1]])->get();
        }else{
            $menus = Menu::has('contact','<',1)->has('parent','<',1)->where('forum','!=',1)->get();
        }
        
        return view('admin.product.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3|unique:products',
                'img' => 'required',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $titleSlug = str_slug($request->title);
        $img       = $request->file('img');
        
        if(!isset($_POST['status'])){
            $status = 1;
        }else{
            $status = $request->status;
        }

        if (count($img) > 5) {
            $request->session()->flash('status', 'File gambar max 5 foto.');
            return back();
        }
        if (empty($img)) {
            $request->session()->flash('status', 'File gambar harus di isi dan max 5 foto.');
            return back();
        }else{
            $user = Auth::user();
            $uniq = date("YmdHis");
            $product = Product::create([
                'menu_id' => $request->menu_id,
                'title' => $request->title,
                'slug' => $titleSlug.'-'.$uniq,
                'uniq' => $uniq,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $status,
                'user_id' => $user->id,
                'comment_status' => 1,
            ]); 
            $files = $request->file('img');
            $key   = 0;
            while ($key < count($files)) {
                $ex       = $files[$key]->getClientOriginalExtension();
                $pictName = $key.'-'.date("YmdHis").'.'.$ex;
                $path     = $files[$key]->getRealPath();
                $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $img->save(public_path("picture/img/". $pictName));
                $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("picture/thumb/". $pictName));
            $key++;
                $picture = new Picture;
                $picture->img        = $pictName;
                $picture->thumb      = $pictName;
                $picture->product_id = $product->id;
                $picture->save();
            }
            return redirect('/admin/product');
        }
    }

    public function status(Request $request, $id){
        $product = Product::find($id);
        $product->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function commentStatus(Request $request, $id){
        $product = Product::find($id);
        $product->update([
                'comment_status' => $request->status,
            ]);
        return back();
    }

    public function show($parent, $child, $slug='')
    {
        if ($slug != null) {
            $product  = Product::where([['slug', $slug],['status', 1]])->first();
        }else{
            $product  = Product::where([['slug', $child],['status', 1]])->first();
            //child berisi slug product karena menu tidak mempunyai parent_id / isi variable bergeser kekiri
        }
        if (count($product)) {
            $pictures  = $product->pictures()->get();
            $promos    = Promo::where([['menu_id', $product->menu_id],['status',1]])->get();
            $comments  = $product->comments()->orderBy('created_at')->paginate(10);
            $prodvotes = Like::where([['likeable_type','App\Product'],['likeable_id',$product->id]])->get();
            //=========
            $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
            $hothreads  = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
            $newproducts = Product::where('status', 1)->latest()->paginate(4);
            $newthreads  = Forum::where('status', 1)->latest()->paginate(4);
            $emoji = Emoticon::all();
            return view('product.show', compact('product','pictures','promos','comments','commentos','hotproducts','hothreads','newproducts','newthreads','emoji'));
        }else{
            return view('errors.503');
        }
    }

    public function edit($id)
    {
        $product = Product::whereId($id)->first();
        $forum = Menu::where('forum',1)->first();
        $menus = Menu::has('contact','<',1)->has('parent','<',1)->where('parent_id','!=',$forum->id)->get();
        $pictures = $product->pictures()->get();
        return view('admin.product.edit', compact('product','menus','pictures'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $product = Product::whereId($id)->first();
        $titleSlug = str_slug($request->title);
        $img       = $request->file('img');
        $jmlPict   = $product->pictures()->count();

        if(!isset($_POST['status'])){
            $status = $product->status;
        }else{
            $status = $request->status;
        }
        
        if (count($img) < 6) {
            if (count($img)+$jmlPict < 6) {
                if (count($img) || $jmlPict) {
                    $user = Auth::user();
                    $uniq = $product->uniq;
                    $product->update([
                        'menu_id' => $request->menu_id,
                        'title' => $request->title,
                        'slug' => $titleSlug.'-'.$uniq,
                        'uniq' => $uniq,
                        'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                        'status' => $status,
                        'user_id' => $user->id,
                        'comment_status' => $product->comment_status,
                    ]); 
                    if (!empty($img)) {
                        $files = $request->file('img');
                        $key   = 0;
                        while ($key < count($files)) {
                            $ex       = $files[$key]->getClientOriginalExtension();
                            $pictName = $key.'-'.date("YmdHis").'.'.$ex;
                            $path     = $files[$key]->getRealPath();
                            $img      = Image::make($path)->resize(null, 630, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $img->save(public_path("picture/img/". $pictName));
                            $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $thumb->save(public_path("picture/thumb/". $pictName));
                        $key++;
                            $picture = new Picture;
                            $picture->img        = $pictName;
                            $picture->thumb      = $pictName;
                            $picture->product_id = $product->id;
                            $picture->save();
                        }
                    }
                    return redirect('/admin/product');
                }else {
                    $request->session()->flash('status', 'Gambar produk anda kosong, silahkan pilih foto untuk di unggah.');
                    return back();
                }
            }else{
                $request->session()->flash('status', 'File gambar tidak boleh lebih dari 5 foto.');
                return back();
            }
        }else{
            $request->session()->flash('status', 'File gambar max 5 foto.');
            return back();
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $picture = Picture::where('product_id',$product->id)->get();
        for ($i=0; $i < count($picture); $i++) { 
            $img   = public_path("picture/img/".$picture[$i]->img);
            $thumb = public_path("picture/thumb/".$picture[$i]->thumb);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
        }
        foreach ($picture as $pict) {
            $pict->delete();
        }
        $comment = Comment::where([['commentable_id',$product->id],['commentable_type','App\Product']])->get();
        foreach ($comment as $comlike) {
            $comlike->likes()->delete();
        }
        $product->comments()->delete();
        $product->likes()->delete();
        $product->delete();
        return back();
    }

}
