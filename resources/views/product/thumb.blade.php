<div id="carousel-{{$product->id}}-generic carousel-thumb-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner inner-thumb">
    @foreach($product->pictures as $pict)
      <div class="item {{ $loop->first ? ' active' : '' }}" >
        <img src="/picture/thumb/{{$pict->thumb}}" alt="">
      </div>
    @endforeach
  </div>
  
</div>