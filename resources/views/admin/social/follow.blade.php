@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
  <style type="text/css">
    .fa input {
      width: 10px;
      margin-left: 5px;
    }
    .fa {
      margin-bottom: 10px;
    }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">

      <div class="col-md-6">
        <div class="news">
          <h4 class="text-center"><b>Tambah Followers Sosial Media</b></h4><hr>
           <form method="POST" action="/admin/follow/store">
          {{ csrf_field() }}

            <div class="form-group{{ $errors->has('social') ? ' has-error' : '' }}">
              <label for="class" class="control-label">Pilih Sosial Media</label>
              
              <div class="form-check">
                <?php for ($i=0; $i< count($sosmed); $i++) { ?>
                  <span class="fa fa-<?=$sosmed[$i] ?>" aria-hidden="true">
                    <input type="radio" name="social" value="<?=$sosmed[$i] ?>"
                      <?php
                        foreach ($follows as $follow) {
                          if ($follow->class == $sosmed[$i]) {
                            echo "disabled";
                          }
                        }
                      ?>
                    >
                  </span>
                <?php  } ?> 
              </div>
              @if ($errors->has('class'))
                  <span class="help-block">
                      <strong>{{ $errors->first('class') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
              <label for="url" class="control-label">Masukan Link / Url Sosial Media :</label>
              <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="https://www.facebook.com/url" required autofocus>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="news">
          <h4><b>Daftar Link Sosial Media</b></h4>
          <div class="table-responsive">
            <table class="table">
              @foreach($follows as $follow)
                <tr>
                  <td><a href="{{$follow->url}}" class="fa fa-{{$follow->class}}" target="_blank"></a></td>
                  <td>@include('admin.social.deleteFollow')</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
        
  </div>
</div>
@endsection
