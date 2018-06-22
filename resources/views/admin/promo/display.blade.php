@if(count($homePromo))
  <hr>
  <table class="table">
  <tr>

    <div id="carousel-promo-<?php foreach($homePromo as $prm){echo $prm->home;} ?>-generic" class="carousel slide" data-ride="carousel">
      
      @if($homePromo->count() > 1)
        <ol class="carousel-indicators">
          @foreach( $homePromo as $prm )
            <li data-target="#carousel-promo-{{$prm->home}}-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
          @endforeach
        </ol>
      @endif

      <div class="carousel-inner inner-promo">
        @foreach ($homePromo as $prm)
          <div class="item {{ $loop->first ? ' active' : '' }}" style="background-color: {{$prm->color}}">
            <img src="/promo/{{$prm->img}}">
            <div style="width: 100%; text-align: center; background-color: rgba(255,255,255,0.6);">
              <a id="edit" href="/admin/promo/{{$prm->id}}/edit">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <small> Edit</small>
              </a> | 
              <a id="edit" href="/admin/promo/{{$prm->home}}/preview">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                <small> Preview</small>
              </a> | 
              <small>
                <i><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Oleh : {{$prm->user->name}}</i>
              </small> | 
              <small>
                <i><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Home</i>
              </small>
            </div>
          </div>
        @endforeach
      </div>

      @if($homePromo->count() > 1)
        <a class="left carousel-control" href="#carousel-promo-<?php foreach($homePromo as $prm){echo $prm->home;} ?>-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-promo-<?php foreach($homePromo as $prm){echo $prm->home;} ?>-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      @endif

    </div>

  </tr>
  </table>
@endif

@foreach ($promosi as $prom)
<table class="table">
<tr>

  <div id="carousel-promo-<?php foreach($prom as $prm){echo $prm->menu_id;} ?>-generic" class="carousel slide" data-ride="carousel">
    
    @if($prom->count() > 1)
      <ol class="carousel-indicators">
        @foreach( $prom as $prm )
          <li data-target="#carousel-promo-{{$prm->menu_id}}-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
      </ol>
    @endif

    <div class="carousel-inner inner-promo">
      @foreach ($prom as $prm)
        <div class="item {{ $loop->first ? ' active' : '' }}" style="background-color: {{$prm->color}}">
          <img src="/promo/{{$prm->img}}">
          <div style="width: 100%; text-align: center; background-color: rgba(255,255,255,0.6);">
            <a id="edit" href="/admin/promo/{{$prm->id}}/edit">
              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
              <small> Edit</small>
            </a> | 
            <a id="edit" href="/admin/promo/{{$prm->menu_id}}/preview">
              <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
              <small> Preview</small>
            </a> | 
            <small>
              <i><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Oleh : {{$prm->user->name}}</i>
            </small> | 
            <small>
              <i><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> {{$prm->menu->menu}}</i>
            </small>
          </div>
        </div>
      @endforeach
    </div>

    @if($prom->count() > 1)
      <a class="left carousel-control" href="#carousel-promo-<?php foreach($prom as $prm){echo $prm->menu_id;} ?>-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-promo-<?php foreach($prom as $prm){echo $prm->menu_id;} ?>-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    @endif

  </div>

</tr>
</table>
@endforeach
