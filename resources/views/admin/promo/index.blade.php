@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
  <div class="row">

  	<div class="col-md-10 col-md-offset-1 news">
      <h5 class="text-center"><b>Tambah Promo</b></h5>
    	<form method="POST" action="/admin/promo/store" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <label for="color" class="control-label">Pilih Background Color Promo :</label>
            <input id="color" type="color" class="form-control" name="color" value="{{ old('color') }}" required autofocus>
            @if ($errors->has('color'))
              <span class="help-block">
                  <strong>{{ $errors->first('color') }}</strong>
              </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
            <label for="menu_id" class="control-label">Pilih Menu</label>
            <select style="background-color: PaleGoldenRod;" name="menu_id" class="form-control">
                <option value="">Pilih Menu</option>
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
              <i>Gambar dengan format gif akan lebih menarik.</i>
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
              <span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan
            </button>
        </div>
      </form>
  	</div>
      
  </div>
  <hr>
  @if(count($homePromo))
    <h5 style="width: 30%; border-bottom: 3px solid brown;"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Home</h5>
    <div class="scrollpromo">
      @foreach ($homePromo as $prm)    
        <figure>
          <img src="/promo/{{$prm->img}}" style="height: 100px; background-color: {{$prm->color}}">
          <figcaption>
            @include('admin.promo.modalStatus')
          </figcaption>
        </figure>
      @endforeach
    </div>
    <hr>
  @endif
  <hr>
  
  @foreach ($promosi as $prom)
    <h5 style="width: 30%; border-bottom: 3px solid brown;"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$prom[0]->menu->menu}}</h5>
    <div class="scrollpromo">
      @foreach ($prom as $prm)
        <figure>
          <img src="/promo/{{$prm->img}}" style="height: 100px; background-color: {{$prm->color}}">
          <figcaption>
            @include('admin.promo.modalStatus')
          </figcaption>
        </figure>
      @endforeach
    </div>
    <hr>
  @endforeach

  <div class="row">
    <h3 class="text-center"><u>DISPLAY PROMO</u></h3>
    <hr>
    @include('admin.promo.display')
  </div>

</div>
@endsection
