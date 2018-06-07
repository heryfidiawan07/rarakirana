<h3 class="sub animated fadeInLeft" style="margin-left: 20px;"><b>Info Terbaru</b></h3><hr>
<div style="width: auto; overflow-x: auto; white-space:nowrap; height: auto;">
	@foreach($newproducts as $product)
		<div class="new-product">
			<a href="/{{$product->menu->url}}/read/{{$product->slug}}">
				<div class="new-img">
					@include('product.thumb')
				</div>
			</a>
			<a href="/{{$product->menu->url}}/read/{{$product->slug}}">
				<div class="menus">
					<b><u>{{$product->menu->menu}}</u></b>
					<small class="pull-right"><i>{{$product->comments->count()}} komentar</i></small>
				</div>
				<div class="product-title"><b>{{ str_limit($product->title, $limit = 50, $end = '...') }}</b></div>
			</a>
		</div>
	@endforeach
</div>