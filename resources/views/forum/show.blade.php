@extends('layouts.app')

@section('url') {{Request::url()}} @stop
@section('title') {{$thread->title}} @stop
@section('description')
  {{ str_limit(strip_tags($thread->description), $limit = 250, $end = '...') }}
@stop
@section('image')
  <?php if (count($logo)) { $url = Request::url(); $loc = explode('/', $url);
      echo $loc[0].'//'.$loc[2].'/part/'.$logo->img; }
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

        @if($thread)

          <h3 class="text-center"><b>{{$thread->title}}</b></h3>
          <hr>
          <div class="description">{!! $thread->description !!}</div>
          
          <div class="row">
            <hr>
            <div class="col-sm-6">
              <a href="/user/{{$thread->user->slug}}">
                <img src="<?php if ($thread->user->img != null){ echo "/users/".$thread->user->img;}else if($thread->user->graph != null){echo $thread->user->graph;}else{echo $thread->user->avatar();} ?>" class="img-circle" alt="user" width="50">
              </a>
              <a href="/user/{{$thread->user->slug}}" class="thread-starter"><b>{{$thread->user->name}}</b></a>
              <small><i>- {{ date('d F Y', strtotime($thread->created_at))}}</i></small>
            </div>
            
            <div class="col-sm-6">
              <a href="/category/{{$thread->menu->url}}" class="btn btn-default btn-sm text-center col-xs-3" style="margin-right: 10px; width: auto;"><span class="glyphicon glyphicon-tags"></span> <b>{{$thread->menu->menu}}</b></a>
              @if(Auth::check())
                @if(Auth::user()->id == $thread->user_id)
                  <a href="/user/forum/{{$thread->id}}/edit" class="btn btn-success btn-sm col-xs-3" style="width: auto;">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Thread
                  </a>
                @endif
              @endif
            </div>
          </div>
        
          @include('layouts.partials.forum-emoji')
          
          <div class="col-md-12 col-xs-12">
            <hr>@include('layouts.partials.share')<hr>
          </div>

          @include('forum.comment')
          
        @endif

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
    
    <div class="col-md-12">
      
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
  <script type="text/javascript" src="/js/forum-comment.js"></script>
  <script type="text/javascript" src="/js/emoji.js"></script>
  <script type="text/javascript" src="/js/comment-like.js"></script>
@stop