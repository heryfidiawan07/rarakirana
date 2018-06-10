@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-9 news">
            <h5 class="text-center">
                <b>Daftar Threads</b>
                <a href="
                <?php
                    if ($menus->count() == 0) {
                        echo '#';
                    }else{
                        echo '/user/forum/create';
                    }
                ?>
                " class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Thread</a>
            </h5>
        	@if($threads->count())
              <table class="table table-hover">
                @foreach($threads as $thread)
                  <tr>
                    <td colspan="5">{{$thread->title}}</td>
                  </tr>
                  <tr class="info">
                    <td>
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <small>{{$thread->user->name}}</small>
                    </td>
                    <td>
                        <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                        <small>{{$thread->comments->count()}}</small>
                    </td>
                    <td>
                        <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                        <small>{{$thread->menu->menu}}</small>
                    </td>
                    <td>@include('admin.forum.threadStatus')</td>
                    <td>@include('admin.forum.threadDelete')</td>
                  </tr>
                @endforeach
              </table>
            @endif
    	</div>
        <div class="col-md-3"></div>
        
    </div>
</div>
@endsection
