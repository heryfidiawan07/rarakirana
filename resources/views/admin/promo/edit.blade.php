@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container-fluid admin-index">
    <div class="row">

    	<div class="col-md-10 col-md-offset-1">
        <h5 class="text-center"><b>Edit Promo</b></h5>
      	<form class="form-horizontal" role="form" method="POST" action="/admin/promo/{{$promo->id}}/update" enctype="multipart/form-data">
          {{ csrf_field() }}

          <img src="/promo/{{$promo->img}}" style="margin: 0 auto; display: block;">
          <hr>
          <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <label for="color" class="pull-left control-label">Pilih Background Color Promo :</label>

            <div class="col-md-2">
                <input id="color" type="color" class="form-control" name="color" value="{{$promo->color}}" required autofocus>
                @if ($errors->has('color'))
                  <span class="help-block">
                      <strong>{{ $errors->first('color') }}</strong>
                  </span>
                @endif
            </div>
          </div>
          
          <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
            <label for="menu_id" class="control-label">Pilih Menu</label>
            <select style="background-color: PaleGoldenRod;" name="menu_id" class="form-control">
              <option value="{{$promo->khususId()}}">Halaman {{$promo->khusus()}}</option>
              <option value="111">Halaman Home</option>
              @foreach($promoMenus as $menu)
                <option value="{{$menu->id}}">Halaman {{$menu->menu}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
            <input type="file" name="img" class="form-control">
            @if ($errors->has('img'))
              <span class="help-block">
                  <strong>{{ $errors->first('img') }}</strong>
              </span>
            @endif
            <label for="img" class="control-label">
              <small>
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                <i>Gambar akan di atur dengan dimensi 1366 x 200 pixel.</i>
              </small>
            </label>
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

    	<div class="col-md-5">
    		
    	</div>
        
    </div>
</div>
@endsection
@section('js')
  <script type="text/javascript" src="/js/mcePromo.js"></script>
@endsection
