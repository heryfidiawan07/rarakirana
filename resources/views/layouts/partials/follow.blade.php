<div class="share-buttons text-center">
	@if($follows->count())
		@foreach($follows as $follow)
			<a href="{{$follow->url}}" target="_blank" class="fa fa-{{$follow->class}}"></a>
		@endforeach
	@else
		@if(Auth::check())
      @if(Auth::user()->admin())
        <a href="/admin/follow" style="color: green;">
          <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
          <small>Admin, <br> Tambahkan link sosial media.</small>
        </a>
      @endif
    @endif
	@endif
</div>