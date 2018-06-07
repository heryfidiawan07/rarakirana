@if(count($weblogo))
	<div class="webTitle"><b>{{$weblogo->description}}</b></div>
@else
	@if(Auth::check())
    @if(Auth::user()->admin())
      <a href="/admin/logo" style="color: green;">
        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
        <small>Admin, <br> Buat deskripsi website.</small>
      </a>
    @endif
  @endif
@endif