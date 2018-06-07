<div class="share-buttons">
	@if($shares->count())
    <b>Share </b>
		@foreach($shares as $share)
			<a href="
        <?php
          $url = $share->url;
          $url = explode('Request::url()', $url);
          $req = Request::url();
          echo $url[0].$req.$url[1];
        ?>
        @yield('title')
        "
        class="fa fa-{{$share->class}}" target="_blank">  
      </a>
		@endforeach
  @else
    @if(Auth::check())
      @if(Auth::user()->admin())
        <a href="/admin/share" style="color: green;">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            <small> Admin, <br> Buat tombol share sosial media.</small>
        </a>
      @endif
    @endif
	@endif
</div>