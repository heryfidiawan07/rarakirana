<div id="carousel-image-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  @if($store->displays->count() > 1)
    <ol class="carousel-indicators carousel-image-indicators">
      @foreach( $displays as $pict )
        <li data-target="#carousel-image-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
      @endforeach
    </ol>
  @endif
  <!-- Wrapper for slides -->
  <div class="carousel-inner carousel-image-inner">
    @foreach( $displays as $pict )
      <div class="item {{ $loop->first ? ' active' : '' }}" >
        <img src="/store/img/{{ $pict->img }}" alt="Gambar">
      </div>
    @endforeach
  </div>
  <!-- Controls -->
  @if($store->displays->count() > 1)
    <a class="left carousel-control carousel-image-control" href="#carousel-image-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control carousel-image-control" href="#carousel-image-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  @endif
</div>