<?php

namespace App\Http\Controllers;

use App\Logo;
use App\Menu;
use App\Post;
use App\Promo;
use App\Forum;
use App\Store;
use App\Product;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function menu(Request $request, $url)
    {   
        
        $menu   = Menu::whereUrl($url)->first();
        if ($menu) {
            $submenus    = Menu::where('parent_id',$menu->id)->get();
            $products    = Product::where('status',1)->latest()->paginate(8);
            $newproducts = Product::where('status', 1)->latest()->paginate(4);
            $hotproducts = Product::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);

            $stores    = Store::where('status',1)->latest()->paginate(8);
            $newstores = Store::where('status', 1)->latest()->paginate(4);
            $hotstores = Store::where('status', 1)->withCount('discusions')->orderBy('discusions_count', 'desc')->paginate(4);

            $logo        = Logo::where('menu_id', $menu->id)->first();
            $promos      = Promo::where([['menu_id', $menu->id],['status',1]])->get();

            $threads     = Forum::latest()->where('status',1)->paginate(6);
            $newthreads  = Forum::where('status', 1)->latest()->paginate(4);
            $hothreads   = Forum::where('status', 1)->withCount('comments')->orderBy('comments_count', 'desc')->paginate(4);
            
            if ($menu->contact == 1) {
                return view('contact.index', compact('menu','logo','promos'));
            }else if ($menu->products()->count() == 1) {
                return redirect("/{$menu->url}/read/{$products[0]->slug}");
            }else if ($menu->stores()->count() == 1) {
                return redirect("/{$menu->url}/shop/{$stores[0]->slug}");
            }else if ($submenus->count()) {
                return view('product.productmenu', compact('products','logo','promos','newproducts','newthreads','hotproducts','hothreads','submenus','menu','stores','newstores','hotstores'));
                //return 'ada sub';
            }else if ($menu->parent()) {
                //return 'sendiri';
                $submenus    = Menu::where('url',$url)->get();
                if ($menu->stores()->count() > 1) {
                    return view('store.storemenu', compact('products','logo','promos','newproducts','newthreads','hotproducts','hothreads','submenus','menu','stores','newstores','hotstores'));
                    //return 'sini';
                }elseif ($submenus == true) {
                    return view('product.productmenu', compact('products','logo','promos','newproducts','newthreads','hotproducts','hothreads','submenus','menu','stores','newstores','hotstores'));
                }
            }
        }else{
            return view('errors.503');
        }
    }

}
