@extends('layouts.app')

@section('url') {{Request::url()}} @stop

@if(count($logo))
  @section('title') {{$logo->title}} @stop
  @section('description')
    {{ str_limit(strip_tags($logo->description), $limit = 250, $end = '...') }}
  @stop
  @section('image')
    <?php if (count($logo)) { $url = Request::url(); $loc = explode('/', $url);
        echo $loc[0].'//'.$loc[2].'/part/'.$logo->img; }
    ?>
  @stop
@endif

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/thumbSlide.css">
@stop

@section('content')
<div class="container">
  <div class="row">

      @if($promos->count())
        @include('promo.index')
      @endif
      
      <div class="col-sm-5 news">

        <h5 class="text-center"><b>{{$menu->menu}}</b></h5>
        @if(session('pesan'))
          <div class="alert alert-success">
              <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{session('pesan')}}
          </div>
        @endif
        <form method="POST" action="/contact/store">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">Email atau nomor telepon</label>
              <input type="text" class="form-control" name="email" value="{{ old('email') }}" <?php
                if (Auth::user()) { ?> placeholder="<?=Auth::user()->email;?>" <?php echo "disabled"; } ?> required autofocus>
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label for="description" class="control-label">Deskripsi</label>
              <textarea cols="10" rows="10" name="description" class="form-control">{{old('description')}}</textarea>
              @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
              @endif
          </div>

          <div class="form-group">
            @include('layouts.partials.recaptcha')
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span> kirim
              </button>
          </div>
        </form>

        <div class="col-xs-12">@include('layouts.partials.share')</div>
        
      </div>
      <div class="col-sm-7"></div>

  </div>
</div>
@endsection
