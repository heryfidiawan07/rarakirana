@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
  
  <div class="row">
    <div class="news media">
      <div class="col-md-4 col-sm-4 col-xs-6">
        <div style="text-align: center;"><h5>PENGUNJUNG<br>ONLINE</h5></div>
        <div style="background-color: aqua; height: 100px; margin: 0 auto; width: 100px; border-radius: 100px; text-align: center;">
          <b style="line-height: 100px; font-size: 20px;">{{$visitors->data_realtime->get('ga:'.$gId, 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors']}}</b>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6">
        <div style="text-align: center;"><h5>TOTAL<br>PENGUNJUNG</h5></div>
        <div style="background-color: pink; height: 100px; margin: 0 auto; width: 100px; border-radius: 100px; text-align: center;">
          <b style="line-height: 100px; font-size: 20px;">{{$stats->groupBy('ip')->count('ip')}}</b>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 col-xs-6">
        <div style="text-align: center;"><h5>PENGUNJUNG<br>HARI INI</h5></div>
        <div style="background-color: lightgrey; height: 100px; margin: 0 auto; width: 100px; border-radius: 100px; text-align: center;"><b style="line-height: 100px; font-size: 20px;">{{$stats->where('tanggal',date('Y-m-d'))->groupBy('ip')->count('ip')}}</b></div>
      </div>
    </div>
  </div>

  <div class="news media">
    <form action="/statistics-period" method="GET" class="form-inline">
      {{ csrf_field() }}
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Periode : </div>
          <input type="number" min="1" max="90" class="form-control" id="period" placeholder="7" name="period">
          <div class="input-group-addon">hari terakhir.</div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Cari</button>
    </form>
  </div>

  <div class="row">
    
      <div class="text-center news"><h3>Google Analytics</h3></div>
      
      <div class="col-md-6">
        <div class="news media">
          <div style="overflow-x:auto; max-height: 400px; overflow-y: auto; margin-top: 50px;">
            <table class="table table-hover">
              <tr>
                <th>Page Url</th>
                <th>Page View</th>
              </tr>
              @foreach($pages as $page)
                <tr>
                  <td>{{$page['url']}}</td>
                  <td>{{$page['pageViews']}}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="news media">
          <div style="overflow-x:auto; max-height: 400px; overflow-y: auto; margin-top: 50px;">
            <table class="table table-hover">
              <tr>
                <th>Page Title</th>
                <th>Page View</th>
                <th>Visitors</th>
              </tr>
              @foreach($views as $view)
                <tr>
                  <td>{{$view['pageTitle']}}</td>
                  <td>{{$view['pageViews']}}</td>
                  <td>{{$view['visitors']}}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>

  </div>

  <div class="row">
  
    <div class="col-md-6">
      <div class="news media">
        <div style="overflow-x:auto; max-height: 400px; overflow-y: auto; margin-top: 50px;">
          <table class="table table-hover">
            <tr>
              <th>Browsers</th>
              <th>Sessions</th>
            </tr>
            @foreach($browsers as $browser)
              <tr>
                <td>{{$browser['browser']}}</td>
                <td>{{$browser['sessions']}}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="news media">
        <div style="overflow-x:auto; max-height: 400px; overflow-y: auto; margin-top: 50px;">
          <table class="table table-hover">
            <tr>
              <th>Referrence Url</th>
              <th>Page View</th>
            </tr>
            @foreach($referrens as $referren)
              <tr>
                <td>{{$referren['url']}}</td>
                <td>{{$referren['pageViews']}}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    
  </div>

  <div class="row">

      <div class="col-md-6">
        <div class="news media">
          @if($gstats->count())
            <h5 class="text-center">
              <b>Daftar Kunjungan</b>
              <form action="/admin/statistic/delete" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input type="number" min="1" max="90" class="form-control" id="period" placeholder="7 hari terakhir" name="hapusKunjungan" style="width: 50%;">
                <input type="submit" name="" class="btn btn-danger" value="Hapus !" style="width: 30%;">
              </form>
            </h5>
            <div style="overflow-x:auto; max-height: 400px; overflow-y: auto;">
              <div class="table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>IP</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Halaman</th>
                  </tr>
                  @foreach($gstats as $stat)
                    <tr>
                      <td class="ip">{{$stat->ip}}</td>
                      <td class="tanggal">{{$stat->tanggal}}</td>
                      <td class="hits">{{$stat->hits}}</td>
                      <td class="page">{{$stat->page}}</td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </div>
          @endif
        </div>
      </div>

      <div class="col-md-6"></div>
        
  </div>

</div>
@endsection
@section('js')
  <script src="/js/statistics.js"></script>
@endsection