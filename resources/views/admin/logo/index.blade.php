@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
  <div class="row">

    <div class="col-md-5">
      <div class="news">
        <h5 class="text-center"><b>Tambah Logo</b></h5>
    	   <form method="POST" action="/admin/logo/store" enctype="multipart/form-data">
        {{ csrf_field() }}

          <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
            <label for="menu_id" class="control-label">Menu</label>

            <select name="menu_id" class="form-control" required autofocus>
              <option value="">Pilih kategori menu</option>
              <option value="111" <?php if (count($khusus1)) {
                echo "class='hidden'";
              } ?> >Logo Utama</option>
              <option value="222" <?php if (count($khusus2)) {
                echo "class='hidden'";
              } ?> >Title Logo</option>
              @if($menus->count())
                @foreach($menus as $menu)
                  <option value="{{$menu->id}}">{{$menu->menu}}</option>
                @endforeach
              @endif
            </select>
            @if ($errors->has('menu_id'))
              <span class="help-block">
                  <strong>{{ $errors->first('menu_id') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
            <input type="file" name="img" class="form-control">
            @if ($errors->has('img'))
                <span class="help-block">
                    <strong>{{ $errors->first('img') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="control-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
            @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="control-label">Deskripsi</label>
            <textarea cols="10" rows="5" name="description" class="form-control">{{old('description')}}</textarea>
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-7">
      <div class="news">
      	@if($logos->count())
          <div class="table-responsive">
            <table class="table table-hover">
              <h5 class="text-center"><b>Daftar Logo</b></h5>
              @foreach($logos as $logo)
                <tr>
                  <td colspan="2">{{$logo->title}}</td>
                  <td>{{$logo->description}}</td>
                  <td>@include('admin.logo.modalString')</td>
                </tr>
                <tr>
                  <td><img src="/part/{{$logo->img}}" width="70"></td>
                  <td>@include('admin.logo.modalImg')</td>
                  <td colspan="2">
                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span> {{$logo->khusus()}}
                  </td>
                </tr>
              @endforeach
            </table>
          </div>
        @endif
        <p><i>Selain logo utama, gambar/logo hanya terlihat ketika halaman di share.</i></p>
      </div>
    </div>
        
  </div>
</div>
@endsection
