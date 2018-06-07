@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-6 news">
        <h5 class="text-center"><b>Daftar Inbox</b></h5>
    		@if($inboxes->count())
          <table class="table table-hover">
            @foreach($inboxes as $inbox)
              <tr>
                <td>{!! $inbox->email !!}</td>
                <td>{{$inbox->ip}}</td>
                <td>{{$inbox->getUser()}}</td>
                <td>
                  <button class="btn btn-primary btn-xs" type="button" data-toggle="collapse" data-target="#pesan-{{$inbox->id}}" aria-expanded="false" aria-controls="pesan-{{$inbox->id}}">
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                  </button>
                </td>
                <tr>
                  <td colspan="4">
                    <div class="collapse" id="pesan-{{$inbox->id}}">
                      <div class="card card-body">
                        {!! nl2br($inbox->description) !!}
                      </div>
                    </div>
                  </td>
                </tr>
              </tr>
            @endforeach
          </table>
          <div class="text-center"><small>{{$inboxes->links()}}</small></div>
        @endif
    	</div>
        
    </div>
</div>
@endsection
