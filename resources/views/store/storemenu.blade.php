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
<div class="container">
  <div class="row">

      @if($promos->count())
        @include('promo.index')
      @endif
      
      <div class="col-md-8">
        <div class="news media" style="margin-top: 20px;">
          
          @if($menu)
            <h3 class="text-center sub"><b>{{$menu->menu}}</b></h3>
            <div class="col-xs-12 text-center">
              @if($menu->parent()->count())
                @foreach($submenus as $sub)
                  <h5 class="submenus"><a href="/{{$sub->url}}"><b>{{$sub->menu}}</b></a></h5>
                @endforeach
              @endif
            </div>
            @foreach($submenus as $sub)
              @include('store.index')
            @endforeach
          @endif
          
          <div class="col-xs-12">@include('layouts.partials.share')</div>

        </div>
      </div>

      <div class="col-md-4">
        
        @if(count($hotstores))
          <div class="news">
            @include('store.hot-store')
          </div>
        @endif
        
        @if($hothreads->count())
          <div class="news">
            @include('forum.hot-threads')
          </div>
        @endif

        @if(count($hotproducts))
          <div class="news">
            @include('product.hot-products')
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
