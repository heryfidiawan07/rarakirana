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
        @include('forum.categorys')
        <hr>
        
        <div class="news media">
  
          @if($threads->count())
            <h3 class="text-center sub"><b>{{$menu->menu}}</b></h3>
            <hr>
            @include('forum.thread-index')
            <div class="col-xs-12 text-center"><span>{{$threads->links()}}</span></div>
          @else
            @if(Auth::check())
              @if(Auth::user()->admin())
                <div class="text-center">
                  <p id="info">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                    Hanya admin yang dapat melihat informasi ini.
                  </p>
                  @if(session('status'))
                    <div class="alert alert-warning">
                      {{session('status')}}
                    </div>
                  @endif
                </div>
              @endif
            @endif
          @endif

          <div class="col-xs-12">@include('layouts.partials.share')</div>

        </div>
      </div>
      
      <div class="col-md-4">

        <div class="media" style="margin-bottom: 20px;">
          @if(Auth::check())
            @if(Auth::user())
              <a href="/user/forum/create" class="btn btn-primary col-xs-12"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Thread</a>
            @endif
          @endif
        </div>

        @if(count($hotproducts))
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

      <div class="col-md-12 col-xs-12">

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
