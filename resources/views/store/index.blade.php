@foreach($stores->where('menu_id',$sub->id) as $store)
<a href="/{{$store->menu->url}}/shop/{{$store->slug}}">
	<div class="col-md-4 col-sm-6 col-xs-12 product-index">
		<div class="index-img">
			@include('store.thumb')
		</div>
		<div class="menus">
			<b><u>{{$store->menu->menu}}</u></b>
			<small class="pull-right"><i>{{$store->discusions->count()}} diskusi</i></small>
		</div>
		<div class="product-title"><b>{{ str_limit($store->title, $limit = 60, $end = '...') }}</b></div>
	</div>
</a>
@endforeach
