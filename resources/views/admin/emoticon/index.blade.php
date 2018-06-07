@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
  <div class="row">

      <div class="col-md-7">
        <div class="news">
          <h4 class="text-center"><b>Emoji</b></h4>
           <form method="POST" action="/admin/emoji/store">
          {{ csrf_field() }}

            <div class="form-group{{ $errors->has('social') ? ' has-error' : '' }}">
              
              <div class="form-check row">
                <div class="col-md-12">
                <?php for ($i=0; $i< count($emoticons); $i++) { ?>
                  <figure style="float: left; display: inline; height: 50px; margin-bottom: 20px; margin-top: 20px;">
                    <img src="/emoji/<?=$emoticons[$i].'.gif' ?>" width="50">
                    <input style="margin-right: 30px;" type="radio" name="emoji" value="<?=$emoticons[$i] ?>"
                      <?php
                        foreach ($emojis as $emoji) {
                          if ($emoji->emoji == $emoticons[$i]) {
                            echo "disabled";
                          }
                        }
                      ?>
                    >
                    <?='<figcaption style="margin-left:15px;">'.'<small>'.$emoticons[$i].'</small>'.'</figcaption>' ?>
                  </figure>
                <?php  } ?>
                </div> 
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

      <div class="col-md-5">
        <div class="news">
          <h4><b>Daftar Emoji</b></h4>
          <div class="table-responsive">
            <table class="table">
              @foreach($emojis as $emoji)
                <tr>
                  <td>
                    <img src="/emoji/{{$emoji->emoji}}.gif" width="40">
                  </td>
                  <td><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$emoji->user->name}}</td>
                  <td>@include('admin.emoticon.emojidelete')</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
      
  </div>
</div>
@endsection
