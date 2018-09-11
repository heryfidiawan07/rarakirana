<div id="carousel-{{$store->id}}-generic carousel-thumb-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner inner-thumb">
    @foreach($store->displays as $pict)
      <div class="item {{ $loop->first ? ' active' : '' }}" >
        <img src="/store/thumb/{{$pict->thumb}}" alt="">
      </div>
    @endforeach
  </div>
  
</div>