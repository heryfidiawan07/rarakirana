<?php

namespace App\Providers;

use Request;
use App\Logo;
use App\Menu;
use App\Promo;
use App\Share;
use App\Follow;
use App\Emoticon;
use App\Statistic;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
    /** **/
        //Statistic Pengunjung
        $page    = Request::url();
        $ip      = Request::ip();//$_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
        $tanggal = date("Ymd"); // Mendapatkan tanggal sekarang
        $waktu   = time(); // 
        
        $cek = Statistic::where([['ip', $ip],['tanggal', $tanggal],['page', $page]])->first();
        if(count($cek) == 0){
            Statistic::create([
                    'ip' => $ip,
                    'tanggal' => $tanggal,
                    'hits' => 1,
                    'online' => $waktu,
                    'page' => $page,
                ]);
        } else{
            $stat = Statistic::where([['ip', $ip],['tanggal', $tanggal],['page',$page]])->first();
            $stat->update([
                    'hits' => $stat->hits+1,
                ]);
        }
    //End Statistic
        $navmenus = Menu::where('parent_id',0)->get();
        $weblogo  = Logo::where('khusus',111)->first();
        $webtitle = Logo::where('khusus',222)->first();
        $follows  = Follow::all();
        $shares   = Share::all();
        $emojis   = Emoticon::all();
        View::share([
                'navmenus' => $navmenus,
                'weblogo' => $weblogo,
                'webtitle' => $webtitle,
                'follows' => $follows,
                'shares' => $shares,
                'emojis' => $emojis
            ]);
    
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
