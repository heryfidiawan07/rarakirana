@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-6 news">
    		@if($users->count())
          <h5 class="text-center"><b>Daftar User</b></h5>
          <div class="user-table">
            <table class="table table-hover">
              @foreach($users as $user)
                <tr <?php if ($user->status == 2) {echo "style='color:red;'";}?>>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>@include('admin.users.modalStatus')</td>
                </tr>
              @endforeach
            </table>
          </div>
          <div class="text-center"><small>{{$users->links()}}</small></div>
        @endif
    	</div>
        
    </div>
</div>
@endsection
