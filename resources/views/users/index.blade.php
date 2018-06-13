@extends('layouts.app')

@section('url') {{Request::url()}} @stop
@section('title') {{$user->name}} @stop
@section('description')
	@if(count($weblogo))
  	{{ str_limit(strip_tags($weblogo->title), $limit = 250, $end = '...') }}
  @endif
@stop
@section('image')
<?php
	$url = Request::url(); $loc = explode('/', $url);
	if ($user->img != null) {
		echo $loc[0].'//'.$loc[2].'/users/'.$user->avatar();
	}else{
		echo $loc[0].'//'.$loc[2].$user->avatar();
	}
?>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
		<div class="col-md-7">
      <div class="pull-left">
      	<img src="<?php if ($user->img != null){ echo "/users/".$user->img;}else if($user->graph != null){echo $user->graph;}else{echo $user->avatar();} ?>" class="img-responsive" alt="user" style="height: 200px;">
        @if(Auth::check())
          @if(Auth::user()->id == $user->id)
            <a role="button" data-toggle="collapse" href="#edit-profil" aria-expanded="false" aria-controls="edit-profil">
              <span class="glyphicon glyphicon-edit"></span> Edit Profil
            </a>
            <div class="collapse" id="edit-profil" style="position: absolute; background-color: lightgrey; padding: 5px;">
              <form class="form-inline" method="POST" action="/user/edit/{{$user->id}}/profil" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="form-group">
                  <input type="text" class="form-control input-xs" name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                  <input type="file" class="form-control input-xs" name="img">
                </div>
                <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
              </form>
            </div>
          @endif
        @endif
      </div>
      <div class="pull-left" style="margin-left: 10px;">
      	<h3><b><a href="/user/{{$user->slug}}">{{$user->name}}</a></b></h3>
      	<p>Bergabung : {{ date('d F - Y', strtotime($user->created_at))}}</p>
        <p>Threads : {{$user->forums->count()}}</p>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
  	<div class="col-md-9">

      @foreach($user->forums as $thread)
        <a href="/forum/{{$thread->menu->url}}/{{$thread->slug}}">
          <div class="col-xs-6 thread-index">
            <div class="thread-title">
              <b>{{ str_limit($thread->title, $limit = 60, $end = '...') }}</b>
            </div>
            
            <a href="/user/{{$thread->user->slug}}">
              <img src="<?php if ($thread->user->img != null) { echo "/users/";} ?>{{$thread->user->avatar()}}" class="img-circle" alt="user" width="50">
            </a>
            <a href="/user/{{$thread->user->slug}}" class="thread-starter"><b>{{$thread->user->name}}</b></a>
            <small><i>- {{ date('d F Y', strtotime($thread->created_at))}}</i></small>
            <p><small class="pull-right"><u>{{$thread->menu->menu}}</u> | {{$thread->comments->count()}} komentar | <span class="glyphicon glyphicon-thumbs-up"></span> {{$thread->likes->count()}}</small></p>
          </div>
        </a>
      @endforeach

  	</div>
  </div>
</div>
@endsection
