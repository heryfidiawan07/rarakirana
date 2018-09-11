@extends('layouts.app')

@section('url') {{Request::url()}} @stop
@section('title') {{$store->title}} @stop
@section('description')
  {{ str_limit(strip_tags($store->description), $limit = 250, $end = '...') }}
@stop
@section('image')
<?php
	$url = Request::url(); $loc = explode('/', $url);
  echo $loc[0].'//'.$loc[2].'/store/img/'.$store->displays[0]->img;
?>
@stop

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/imageSlide.css">
@stop
@section('content')
<div class="container">
  <div class="row">

      @if($promos->count())
        @include('promo.index')
      @endif
      
    <div class="col-md-8">
      <div class="bodyShow media">

        @if($store)
          <h3 class="text-center"><b>{{$store->title}}</b></h3>
          <hr>
          <div class="gambarUtama">
            @include('store.image')
            <div class="text-center"><small><i>{{$store->title}}</i></small></div>
          </div>
          <br>
          <div class="description">{!! $store->description !!}</div>
          
          <div class="media">
            <a href="/{{$store->menu->url}}" class="btn btn-default btn-sm text-center col-xs-3" style="margin-right: 10px; width: auto;"><span class="glyphicon glyphicon-tags"></span> <b>{{$store->menu->menu}}</b></a>
          </div>
          
          @include('layouts.partials.store-emoji')

          <div class="col-xs-12"><hr>@include('layouts.partials.share')<hr></div>
          @include('store.comment')
          
        @endif
        
      </div>
    </div>

    <div class="col-md-4">

      @if($hotstores->count())
        <div class="news">
          @include('store.hot-store')
        </div>
      @endif

      @if($hotproducts->count())
        <div class="news">
          @include('product.hot-products')
        </div>
      @endif
      
      @if($hothreads->count())
        <div class="news">
          @include('forum.hot-threads')
        </div>
      @endif

    </div>

    <div class="col-md-12">

      @if($newstores->count())
        <div class="news">
          @include('store.new-store')
        </div>
      @endif

      @if($newproducts->count())
        <div class="news">
          @include('product.new-product')
        </div>
      @endif
      
      @if($newthreads->count())
        <div class="news media">
          @include('forum.new-threads')
        </div>
      @endif

    </div>

  </div>
</div>
@endsection
@section('js')
  <script type="text/javascript" src="/js/store-comment.js"></script>
  <script type="text/javascript" src="/js/emoji.js"></script>
  <script type="text/javascript" src="/js/discus-like.js"></script>
@stop