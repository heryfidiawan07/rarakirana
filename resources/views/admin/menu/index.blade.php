@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-3">
            <div class="news">
                <h5 class="text-center"><b>Tambah Menu</b></h5>
            	<form method="POST" action="/admin/tambah-menu">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('menu') ? ' has-error' : '' }}">
                    <label for="menu" class="control-label">Nama Menu</label>

                    <input id="menu" type="text" class="form-control" name="menu" value="{{ old('menu') }}" required autofocus>

                    @if ($errors->has('menu'))
                        <span class="help-block">
                            <strong>{{ $errors->first('menu') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    <label for="parent_id" class="control-label">Menu Induk</label>

                    <select name="parent_id" class="form-control" required autofocus>
                      <option value="0">Pilih Menu Induk atau Biarkan Kosong</option>
                      @if($menus->count())
                        @foreach($induxs as $menu)
                          <option value="{{$menu->id}}">{{$menu->menu}}</option>
                        @endforeach
                      @endif
                    </select>

                    @if ($errors->has('parent_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="status" class="control-label">Setel Sebagai :</label>
                    <div class="form-check">
                      <label style="margin-right: 50px;">
                        <input type="radio" name="forcont" value="contact">
                        <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Kontak
                      </label>
                      <label>
                        <input type="radio" name="forcont" value="forum"
                        <?php
                            if ($forum) {
                                echo "disabled";
                            }  
                        ?>
                        ><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Forum
                      </label>
                    </div>
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> simpan</button>
                </div>
              </form>
            </div>
    	</div>

    	<div class="col-md-9">
            <div class="news">
               <h5 class="text-center"><b>Daftar Menu</b></h5>
        	   @if($menus->count())
                    <table class="table table-hover">
                        @foreach($menus->where('childs',null) as $menu)
                          <tr>
                                @if($menu->parent()->count())
                                    <td>
                                        {{$menu->menu}}
                                        @if($menu->contact == 1)
                                             - <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                        @elseif($menu->forum == 1)
                                            - <span class="glyphicon glyphicon-user" aria-hidden="true"><span class="glyphicon glyphicon-user" aria-hidden="true">
                                        @endif
                                    </td>
                                @endif
                                @if($menu->parent()->count() < 1)
                                    <td>
                                        {{$menu->menu}}
                                        @if($menu->contact == 1)
                                             - <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                        @elseif($menu->forum == 1)
                                            - <span class="glyphicon glyphicon-user" aria-hidden="true"><span class="glyphicon glyphicon-user" aria-hidden="true">
                                        @endif
                                    </td>
                                @endif
                                <td>@include('admin.menu.modalEdit')</td>
                                <td>@include('admin.menu.modalDelete')</td>
                                <td>
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    <small>{{$menu->user->name}}</small>
                                </td>
                                <td><small>{{$menu->products->count()}}<i> post</i></small></td>
                            @foreach($menus->where('parent_id',$menu->id) as $child)
                                <tr>
                                    <td style="padding-left: 30px;">
                                        {{$child->menu}}
                                        @if($child->contact == 1)
                                             - <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                                        @elseif($child->forum == 1)
                                            - <span class="glyphicon glyphicon-user" aria-hidden="true"><span class="glyphicon glyphicon-user" aria-hidden="true">
                                        @endif
                                    </td>
                                    <td>@include('admin.menu.childModalEdit')</td>
                                    <td>@include('admin.menu.childModalDelete')</td>
                                    <td>
                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                        <small>{{$child->user->name}}</small>
                                    </td>
                                    <td><small>{{$child->products->count()}}<i> post</i></small></td>
                                </tr>
                            @endforeach
                          </tr>
                        @endforeach
                    </table>
                @endif
            </div>
    	</div>
        
    </div>
</div>
@endsection
