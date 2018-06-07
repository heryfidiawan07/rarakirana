@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="/css/admin.css">
@stop
@section('content')
<div class="container">
    <div class="row">

    	<div class="col-md-3">
            <div class="news">
                <h5 class="text-center"><b>Tambah Kategori</b></h5>
            	<form method="POST" action="/admin/forum/tambah-kotegori">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label for="category" class="control-label">Nama Kategori</label>
                    <input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus 
                    <?php
                        if (!$forum) {
                            echo "readonly placeholder='Menu Forum Belum di tentukan'";
                        }
                    ?>
                    >
                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('parent_forum') ? ' has-error' : '' }}">
                    <label for="parent_id" class="control-label">Menu Induk</label>

                    <select name="parent_forum" class="form-control" required autofocus>
                      <option value="0">Pilih Menu Induk atau Biarkan Kosong</option>
                      @if($categorys)
                        @foreach($induxs as $menu)
                            @if($menu->parent_forum != null)
                                @continue
                            @endif
                          <option value="{{$menu->id}}">{{$menu->menu}}</option>
                        @endforeach
                      @endif
                    </select>

                    @if ($errors->has('parent_forum'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent_forum') }}</strong>
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
                <h5 class="text-center">
                    <b>Forum Kategori/Tags</b>
                    <a href="/user/forum/create" class="btn btn-primary btn-sm"
                    <?php
                        if (!$forum) {
                            echo "disabled";
                        }
                    ?>
                    ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Thread</a>
                </h5>
            	@if($categorys)
                  <table class="table table-hover">
                    @foreach($categorys->where('parent_forum',0) as $category)
                      <tr>
                            @if($category->parentForum()->count())
                              <td style="background-color: lightgrey;">{{$category->menu}}</td>
                            @endif
                            @if($category->parentForum()->count() < 1)
                              <td>{{$category->menu}}</td>
                            @endif
                        <td>@include('admin.forum.modalEdit')</td>
                        <td>@include('admin.forum.modalDelete')</td>
                        <td>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <small>{{$category->user->name}}</small>
                        </td>
                        <td><small>{{$category->forums->count()}}<i> threads</i></small></td>
                        @foreach($categorys->where('parent_forum',$category->id) as $child)
                            <tr>
                                <td style="padding-left: 30px;">{{$child->menu}}</td>
                                <td>@include('admin.forum.childModalEdit')</td>
                                <td>@include('admin.forum.childModalDelete')</td>
                                <td>
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    <small>{{$child->user->name}}</small>
                                </td>
                                <td><small>{{$child->forums->count()}}<i> threads</i></small></td>
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
