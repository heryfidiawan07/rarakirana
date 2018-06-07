<?php

namespace App\Http\Controllers;


use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;

use App\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{

    public function index()
    {   
        $date = Carbon::today(); //  DateTime string will be 2014-04-03 13:57:34
        $date->subDays(7);//$date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
        $gstats = Statistic::where('tanggal', '>', $date->toDateTimeString() )->latest()->get();
        $stats = Statistic::latest()->get();
        //Google Analytics
        $views = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $browsers = Analytics::fetchTopBrowsers(Period::days(7));
        $pages = Analytics::fetchMostVisitedPages(Period::days(7));
        $referrens = Analytics::fetchTopReferrers(Period::days(7));
        $gId = env('ANALYTICS_VIEW_ID');//dd($views[0]['date']); //Period::months(6)
        $visitors = Analytics::getAnalyticsService();
        return view('admin.statistic.index',compact('stats','pages','views','browsers','referrens','visitors','gId','gstats'));
    }

    public function statistics(Request $request){
        $sub = $request->period;
        $date = Carbon::today(); //  DateTime string will be 2014-04-03 13:57:34
        $date->subDays($sub);//$date->subWeek(); // or $date->subDays(7),  2014-03-27 13:58:25
        $gstats = Statistic::where('tanggal', '>', $date->toDateTimeString() )->latest()->get();
        $stats = Statistic::latest()->get();
        //Google Analytics
        $views = Analytics::fetchVisitorsAndPageViews(Period::days($sub));
        $browsers = Analytics::fetchTopBrowsers(Period::days($sub));
        $pages = Analytics::fetchMostVisitedPages(Period::days($sub));
        $referrens = Analytics::fetchTopReferrers(Period::days($sub));
        $gId = env('ANALYTICS_VIEW_ID');//dd($views[0]['date']); //Period::months(6)
        $visitors = Analytics::getAnalyticsService();
        return view('admin.statistic.index',compact('stats','pages','views','browsers','referrens','visitors','gId','gstats'));
    }

}
