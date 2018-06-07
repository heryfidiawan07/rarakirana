@extends('layouts.app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop

@section('content')
<div class="container-fluid">
  <div class="row">

    @include('promo.index')
  
    <br>
    <p id="info" class="text-center">
      <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
      Design ini akan di tampilkan pada header halaman {{$promos[1]->khusus()}}
    </p>
  
  </div>
</div>
@endsection
