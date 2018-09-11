<h3 class="sub animated fadeInLeft" style="margin-left: 10px;"><b>Produk Terbaru</b></h3><hr>
<div style="width: auto; overflow-x: auto; white-space:nowrap; height: auto;">
	@foreach($newstores as $store)
		<div class="new-store">
			<a href="/{{$store->menu->url}}/shop/{{$store->slug}}">
				<div class="new-img">
					@include('store.thumb')
				</div>
			</a>
			<a href="/{{$store->menu->url}}/shop/{{$store->slug}}">
				<div class="menus">
					<b><u>{{$store->menu->menu}}</u></b>
					<small class="pull-right"><i>{{$store->discusions->count()}} diskusi</i></small>
				</div>
				<div class="store-title"><b>{{ str_limit($store->title, $limit = 50, $end = '...') }}</b></div>
			</a>
		</div>
	@endforeach
</div>