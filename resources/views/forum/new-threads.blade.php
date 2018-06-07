<h3 class="sub animated fadeInLeft"><b>Threads Baru</b></h3><hr>
@foreach($newthreads as $thread)
  <a href="/category/{{$thread->menu->url}}/{{$thread->slug}}">
  	<div class="thread-index col-xs-12 col-sm-6" onclick="location.href='/category/{{$thread->menu->url}}/{{$thread->slug}}';" style="cursor:pointer;">
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
