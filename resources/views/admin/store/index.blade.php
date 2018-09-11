@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
  <link rel="stylesheet" type="text/css" href="/css/thumbSlide.css">
@stop
@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-10 news">
      <div class="text-center">
        <b>Daftar produk</b>
        <a href="/admin/store/create" class="btn btn-sm btn-primary pull-right"
        <?php
          if($menus->count() == 0){
            echo "disabled";
          }
        ?>  
        >
          <span class="glyphicon glyphicon-book" aria-hidden="true"></span> 
          Tambah produk
        </a>
      </div>
      <hr>
      @if($stores->count())
        @foreach($stores as $store)
        <div class="table-responsive">
          <table class="table table-index" style="border-left: 3px solid brown;">
            <tr>
              <td><div class="admin-thumb">@include('store.thumb')</div></td>
              <td colspan="3"><b>{{ str_limit($store->title, $limit = 200, $end = '...') }}</b></td>
            </tr>
            <tr class="success">
              <td>
                <small>
                  <i><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$store->menu->menu}}</i>
                </small>
              </td>
              <td>
                <small>
                  <i><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Oleh : {{$store->user->name}}</i>
                </small>
              </td>
              <td>
                <span class="glyphicon glyphicon-time" aria-hidden="true">
                <small></span>
                <i>Created : {{ date('d F - Y', strtotime($store->created_at))}} pukul {{date('g:ia', strtotime($store->created_at))}}</i></small>
              </td>
              <td colspan="2">
                <span class="glyphicon glyphicon-time" aria-hidden="true">
                <small></span>
                <i>Updated : {{ date('F d, Y', strtotime($store->updated_at))}} pukul {{date('g:ia', strtotime($store->updated_at))}}</i></small>
              </td>
            </tr>
            <tr class="success">
              <td>
                <a class="btn btn-primary btn-xs" href="/admin/store/{{$store->id}}/edit">
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                  <small> Edit</small>
                </a>
              </td>
              <td>@include('admin.store.modalDelete')</td>
              <td>@include('admin.store.modalStatus')</td>
              <td><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> {{$store->discusions->count()}} diskusi</td>
            </tr>
          </table>
        </div>
        @endforeach
        <div class="text-center"><small>{{$stores->links()}}</small></div>
      @endif
    </div>

    <div class="col-md-2"></div>
      
  </div>
</div>
@endsection
@section('js')
  <script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script type="text/javascript" src="/js/mce.js"></script>
  <script type="text/javascript" src="/js/admin.js"></script>
@endsection
