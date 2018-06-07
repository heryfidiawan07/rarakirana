<div id="carousel-promo-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  @if($promos->count() > 1)
    <ol class="carousel-indicators carousel-promo-indicators">
      @foreach( $promos as $promo )
        <li data-target="#carousel-promo-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
      @endforeach
    </ol>
  @endif
  <!-- Wrapper for slides -->
  <div class="carousel-inner inner-promo">
    @foreach( $promos as $promo )
      <div class="item {{ $loop->first ? ' active' : '' }}" style="background-color: {{$promo->color}}">
        <img src="/promo/{{$promo->img}}">
      </div>
    @endforeach
  </div>
  <!-- Controls -->
  @if($promos->count() > 1)
    <a class="left carousel-control carousel-promo-control" href="#carousel-promo-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control carousel-promo-control" href="#carousel-promo-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  @endif
</div>
<br>