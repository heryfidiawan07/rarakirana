@extends('layouts.app')

@section('url') {{Request::url()}} @stop

@if(count($logo))
  @section('title') {{$logo->title}} @stop
  @section('description')
    {{ str_limit(strip_tags($logo->description), $limit = 250, $end = '...') }}
  @stop
  @section('image')
    <?php if (count($logo)) { $url = Request::url(); $loc = explode('/', $url);
      echo $loc[0].'//'.$loc[2].'/part/'.$logo->img; }
    ?>
  @stop
@endif

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/thumbSlide.css">
@stop

@section('content')
<div class="container-fluid">
  <div class="row">

    @if($promos->count())
      @include('promo.index')
    @endif

    @if($newproducts->count())
      <div class="col-xs-12 news">@include('product.new-product')</div>
    @endif
    <br>
    <div class="col-md-8 col-xs-12">
      @if($newthreads->count())
        <div class="news media">@include('forum.new-threads')</div>
      @endif
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-6 col-xs-12">
      @if(count($hotproducts))
        <div class="news media">@include('product.hot-products')</div>
      @endif
    </div>
    <div class="col-md-6 col-xs-12">
      @if($hothreads->count())
        <div class="news media">@include('forum.hot-threads')</div>
      @endif
    </div>

    <div class="col-xs-12">@include('layouts.partials.share')</div>

  </div>
</div>
@endsection
