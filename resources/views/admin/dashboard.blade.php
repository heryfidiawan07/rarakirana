@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
  <link rel="stylesheet" type="text/css" href="/css/calendar.css">
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
      
      <div class="text-center"><h3 class="sub"><b>Admin Dashboard</b></h3></div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
      	<div id="ui1">
          <div class="dashboad-title">
      		  <b>Membuat menu baru atau edit menu sesuai kebutuhan.</b>
          </div>
        	<hr>
					<p class="pdashboard"><a href="/admin/menu"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Daftar Menu</a></p>
      	</div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
      	<div id="ui2">
          <div class="dashboad-title">
      		  <b>Posting berita atau artikel atau produk sesuai kebutuhan.</b>
          </div>
        	<hr>
          <p class="pdashboard"><a href="/admin/product"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Post/Produk</a></p>
          @if($menus->count())
            <p class="pdashboard"><a href="/admin/product/create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Produk</a></p>
          @endif
      	</div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui3">
          <div class="dashboad-title"><b>Admin Forum</b></div>
          <hr>
          <p class="pdashboard"><a href="/admin/forum"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Buka</a></p>
          <p class="pdashboard"><a href="/admin/threads"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Threads</a></p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui4">
          <div class="dashboad-title">
            <b>Tambahkan logo agar website anda terlihat lebih profesional.</b>
          </div>
          <hr>
          <p class="pdashboard"><a href="/admin/logo"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Buka</a></p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui5">
          <div class="dashboad-title">
            <b>Tambah sebuah promo atau update khusus untuk halaman utama.</b>
          </div>
          <hr>
          <p class="pdashboard"><a href="/admin/promo"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Buka</a></p>
        </div>
      </div>

    	<div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
      	<div id="ui6">
          <div class="dashboad-title"><b>Admin Sosial Media</b></div>
          <hr>
          <p class="pdashboard"><a href="/admin/share"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Tombol Share</a></p>
          <p class="pdashboard"><a href="/admin/follow"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Tombol Follow</a></p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui7">
          <div class="dashboad-title"><b>Statistik Pengunjung</b></div>
          <hr>
          <p class="pdashboard"><a href="/admin/users"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Daftar User</a></p>
          <p class="pdashboard"><a href="/admin/statistic"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Lihat Statistik</a></p>
        </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui8">
          <div class="dashboad-title"><b>Informasi Admin</b></div>
          <hr>
          <p class="pdashboard"><a href="/admin/inbox"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Buka</a></p>
        </div>
      </div>
      
      <div class="col-md-3 col-sm-4 col-xs-12 dashboardUi">
        <div id="ui9">
          <div class="dashboad-title"><b>Admin Emoji</b></div>
          <hr>
          <p class="pdashboard"><a href="/admin/emoji"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Buka</a></p>
        </div>
      </div>
    
    <div class="col-md-9 col-sm-8 col-xs-12 dashboardUi">
      <div style="overflow-x:auto;">
        <div id="calendar">
          <div id="calendar_header">
            <i class="icon-chevron-left glyphicon glyphicon-chevron-left"></i>
            <h1></h1>
            <i class="icon-chevron-right glyphicon glyphicon-chevron-right"></i>
          </div>
          <div id="calendar_weekdays"></div>
          <div id="calendar_content"></div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
@section('js')
  <script type="text/javascript" src="/js/calendar.js"></script>
@stop