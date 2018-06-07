<h3 class="text-center sub animated fadeInLeft"><b>Populer</b></h3><hr>
<div class="hothreads">
  @foreach($hotproducts as $product)
    <a href="/{{$product->menu->url}}/read/{{$product->slug}}">
      <div class="col-xs-12 index-hotproducts">
        <div class="hotproducts-img">
          @include('product.thumb')
        </div>
        <div class="product-title"><b>{{ str_limit($product->title, $limit = 40, $end = '...') }}</b></div>
        <div class="menus">
          <b><u>{{$product->menu->menu}}</u></b>
          <small class="pull-right"><i>{{$product->comments->count()}} komentar</i></small>
        </div>
      </div>
    </a>
  @endforeach
</div>