@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
  <div class="row">

  	<div class="col-md-9 news">
      <h5 class="text-center"><b>Tulis Thread</b></h5>
    	<form method="POST" action="/user/forum/store">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
          <label for="menu_id" class="control-label">Pilih Kategori</label>
          <select style="background-color: PaleGoldenRod;" name="menu_id" class="form-control">
            <option value="">Pilih Kategori</option>
            @foreach($threadMenus as $menu)
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

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="control-label">Deskripsi <small><i>- Hanya video youtube</i></small></label>
            <textarea cols="10" rows="15" name="description" class="form-control">{{old('description')}}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-send" aria-hidden="true"></span> kirim
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
  <script type="text/javascript" src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script type="text/javascript" src="/js/mce-forum.js"></script>
@endsection
