@foreach($products->where('menu_id',$sub->id) as $product)
<a href="/{{$product->menu->url}}/read/{{$product->slug}}">
	<div class="col-md-4 col-sm-6 col-xs-12 product-index">
		<div class="index-img">
			@include('product.thumb')
		</div>
		<div class="menus">
			<b><u>{{$product->menu->menu}}</u></b>
			<small class="pull-right"><i>{{$product->comments->count()}} komentar</i></small>
		</div>
		<div class="product-title"><b>{{ str_limit($product->title, $limit = 60, $end = '...') }}</b></div>
	</div>
</a>
@endforeach
