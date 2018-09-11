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
use App\Display;
use App\Store;
use App\Product;
use App\Comment;
use App\Emoticon;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except'=>'show']);
    }

    public function index()
    {
        $menus  = Menu::all();
        $stores = Store::latest()->paginate(8);
        return view('admin.store.index', compact('stores','menus'));
    }

    public function create()
    {
        $forum = Menu::where('forum',1)->first();//Error jika menu forum belum di tentukan
        if ($forum) {
            $menus = Menu::has('contact','<',1)->has('parent','<',1)->has('products','<',1)->where([['parent_id','!=',$forum->id],['forum','!=',1]])->get();
        }else{
            $menus = Menu::has('contact','<',1)->has('parent','<',1)->has('products','<',1)->where('forum','!=',1)->get();
        }
        
        return view('admin.store.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3|unique:stores',
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
            $store = Store::create([
                'menu_id' => $request->menu_id,
                'title' => $request->title,
                'slug' => $titleSlug.'-'.$uniq,
                'uniq' => $uniq,
                'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                'status' => $status,
                'user_id' => $user->id,
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
                $img->save(public_path("store/img/". $pictName));
                $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                $thumb->save(public_path("store/thumb/". $pictName));
            $key++;
                $display = new Display;
                $display->img      = $pictName;
                $display->thumb    = $pictName;
                $display->store_id = $store->id;
                $display->save();
            }
            return redirect('/admin/store');
        }
    }

    public function status(Request $request, $id){
        $store = Store::find($id);
        $store->update([
                'status' => $request->status,
            ]);
        return back();
    }

    public function show($parent, $child, $slug='')
    {
        if ($slug != null) {
            $store  = Store::where([['slug', $slug],['status', 1]])->first();
        }else{
            $store  = Store::where([['slug', $child],['status', 1]])->first();
            //child berisi slug Store karena menu tidak mempunyai parent_id / isi variable bergeser kekiri
        }
        if (count($store)) {
            $displays  = $store->displays()->get();
            $promos    = Promo::where([['menu_id', $store->menu_id],['status',1]])->get();
            $discus    = $store->discusions()->orderBy('created_at')->paginate(10);
            //$prodvotes = Like::where([['likeable_type','App\Product'],['likeable_id',$store->id]])->get();
            //=========
            $hotstores   = Store::where('status', 1)->withCount('discusions')->orderBy('discusions_count', 'desc')->paginate(4);
            $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
            $hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
            $newstores   = Store::where('status', 1)->latest()->paginate(4);
            $newproducts = Product::where('status', 1)->latest()->paginate(4);
            $newthreads  = Forum::where('status', 1)->latest()->paginate(4);
            $emoji       = Emoticon::all();
            return view('store.show', compact('product','displays','comments','promos','discus','hotproducts','hothreads','newproducts','newthreads','emoji','store','hotstores','newstores'));
        }else{
            return view('errors.503');
        }
    }

    public function edit($id)
    {
        $store = Store::whereId($id)->first();
        $forum = Menu::where('forum',1)->first();
        $menus = Menu::has('contact','<',1)->has('parent','<',1)->where('parent_id','!=',$forum->id)->get();
        $displays = $store->displays()->get();
        return view('admin.store.edit', compact('store','menus','displays'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'title' => 'required|max:255|min:3',
                'menu_id' => 'required',
                'description' => 'required',
            ]);
        $store = Store::whereId($id)->first();
        $titleSlug = str_slug($request->title);
        $img       = $request->file('img');
        $jmlPict   = $store->displays()->count();

        if(!isset($_POST['status'])){
            $status = $store->status;
        }else{
            $status = $request->status;
        }
        
        if (count($img) < 6) {
            if (count($img)+$jmlPict < 6) {
                if (count($img) || $jmlPict) {
                    $user = Auth::user();
                    $uniq = $store->uniq;
                    $store->update([
                        'menu_id' => $request->menu_id,
                        'title' => $request->title,
                        'slug' => $titleSlug.'-'.$uniq,
                        'uniq' => $uniq,
                        'description' => Purifier::clean($request->description, array('CSS.AllowTricky' => true , 'HTML.SafeIframe' => true , "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%")),
                        'status' => $status,
                        'user_id' => $user->id,
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
                            $img->save(public_path("store/img/". $pictName));
                            $thumb    = Image::make($path)->resize(null, 200, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                            $thumb->save(public_path("store/thumb/". $pictName));
                        $key++;
                            $display = new Display;
                            $display->img        = $pictName;
                            $display->thumb      = $pictName;
                            $display->Store_id = $store->id;
                            $display->save();
                        }
                    }
                    return redirect('/admin/store');
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
        $store   = Store::find($id);
        $display = Display::where('store_id',$store->id)->get();
        for ($i=0; $i < count($display); $i++) { 
            $img   = public_path("store/img/".$display[$i]->img);
            $thumb = public_path("store/thumb/".$display[$i]->thumb);
            if (file_exists($img)) {
                File::delete($img);
                File::delete($thumb);
            }
        }
        foreach ($display as $pict) {
            $pict->delete();
        }
        $store->discusions()->delete();
        //$store->likes()->delete();//favorit
        $store->delete();
        return back();
    }
}
