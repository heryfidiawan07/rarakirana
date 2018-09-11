@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">

  	<div class="col-md-9 news">
      <h5 class="text-center"><b>Edit product</b></h5>
    	<form method="POST" action="/admin/store/{{$store->id}}/update" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="menu_id" class="control-label">Pilih Menu</label>
          <select style="background-color: PaleGoldenRod;" name="menu_id" class="form-control">
            <option value="{{$store->menu_id}}">{{$store->menu->menu}}</option>
            @foreach($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->menu}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">Judul</label>
            <input type="text" class="form-control" name="title" value="{{$store->title}}" required autofocus>
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
            <div class="">
              @foreach($displays as $pict)
              <div style="display: inline-block; text-align: center;">
                <img src="/store/thumb/{{$pict->thumb}}" width="100" height="100"><br>
                <a class="btn btn-danger btn-xs" href="/admin/display/{{$pict->id}}/destroy"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </div>
              @endforeach
            </div>
            <label for="img" class="control-label">Upload Gambar</label>
            @include('layouts.partials.multiupload')
            @if(session('status'))
                <div class="alert alert-warning">
                    {{session('status')}}
                </div>
            @endif
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="control-label">Deskripsi</label>
            <textarea cols="10" rows="20" name="description" class="form-control">{{$store->description}}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status" class="control-label">Status</label>
            <div class="form-check">
              <label style="margin-right: 50px; color: green;">
                <input type="radio" name="status" value="1">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Aktif
              </label>
              <label style="color: red;">
                <input type="radio" name="status" value="0">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> Tidak Aktif
              </label>
            </div>
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-send" aria-hidden="true"></span> update
            </button>
        </div>
      </form>
  	</div>

  	<div class="col-md-3"></div>

</div>
@endsection
@section('js')
  <script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script type="text/javascript" src="/js/mce.js"></script>
@endsection
