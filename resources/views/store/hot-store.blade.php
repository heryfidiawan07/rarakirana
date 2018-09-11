<h3 class="text-center sub animated fadeInLeft"><b>Populer</b></h3><hr>
<div class="hothreads">
  @foreach($hotstores as $store)
    <a href="/{{$store->menu->url}}/shop/{{$store->slug}}">
      <div class="col-xs-12 index-hotproducts">
        <div class="hotproducts-img">
          @include('store.thumb')
        </div>
        <div class="store-title"><b>{{ str_limit($store->title, $limit = 40, $end = '...') }}</b></div>
        <div class="menus">
          <b><u>{{$store->menu->menu}}</u></b>
          <small class="pull-right"><i>{{$store->discusions->count()}} diskusi</i></small>
        </div>
      </div>
    </a>
  @endforeach
</div>