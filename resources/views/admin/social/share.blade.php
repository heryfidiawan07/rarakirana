@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
  <style type="text/css">
    .fa input {
      width: 10px;
      margin-left: 5px;
    }
  </style>
@stop
@section('content')
<div class="container">
  <div class="row">

      <div class="col-md-5">
        <div class="news">
          <h4 class="text-center"><b>Tombol Share</b></h4>
           <form method="POST" action="/admin/share/store">
          {{ csrf_field() }}

            <div class="form-group{{ $errors->has('social') ? ' has-error' : '' }}">
              <label for="class" class="control-label">Pilih Sosial Media</label>
              
              <div class="form-check">
                <?php for ($i=0; $i< count($sosmed); $i++) { ?>
                  <span class="fa fa-<?=$sosmed[$i] ?>" aria-hidden="true">
                    <input type="radio" name="social" value="<?=$sosmed[$i] ?>"
                      <?php
                        foreach ($shares as $share) {
                          if ($share->class == $sosmed[$i]) {
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

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="news">
          <h4><b>Daftar Share Sosial Media</b></h4>
          <div class="table-responsive">
            <table class="table">
              @foreach($shares as $share)
                <tr>
                  <td>
                    <a href="
                      <?php
                        $url = $share->url;
                        $url = explode('Request::url()', $url);
                        $req = Request::url();
                        echo $url[0].$req.$url[1];
                      ?>
                      @yield('title')
                      "
                      class="fa fa-{{$share->class}}" target="_blank"></a>
                  </td>
                  <td>@include('admin.social.deleteShare')</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
        
  </div>
</div>
@endsection
