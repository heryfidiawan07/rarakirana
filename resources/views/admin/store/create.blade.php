@extends('layouts.app')

@section('css')
	<link href="/css/admin.css">
@stop
@section('content')
<div class="container">
  <div class="row">

  	<div class="col-md-9 news">
      <h5 class="text-center"><b>Tulis Produk</b></h5>
    	<form method="POST" action="/admin/store/store" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
          <label for="menu_id" class="control-label">Pilih Menu</label>
          <select style="background-color: PaleGoldenRod;" name="menu_id" class="form-control">
            <option value="">Pilih Menu</option>
            @foreach($menus as $menu)
              <option value="{{$menu->id}}">{{$menu->menu}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">Judul</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
            @include('layouts.partials.multiupload')
            @if(session('img'))
                <div class="alert alert-warning">
                    {{session('img')}}
                </div>
            @endif
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="control-label">Deskripsi</label>
            <textarea cols="10" rows="15" name="description" class="form-control">{{old('description')}}</textarea>
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
              <span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan
            </button>
        </div>
      </form>
  	</div>

  	<div class="col-md-3">
    </div>

  </div>
</div>
@endsection
@section('js')
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script src="/js/mce.js"></script>
@endsection
