<a class="btn btn-primary btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalLogoString_{{$logo->id}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit <span class="caret"></span></a>

<div class="modal fade modalLogoString_{{$logo->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

    <div class="modal-header"><h5 class="text-center">Edit Logo</h5></div>
    
    <div class="modal-body" style="padding: 20px;">
      <form class="form-horizontal" role="form" method="POST" action="/admin/logo/{{$logo->id}}/updateDesc" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          <label for="title" class="control-label">Title</label>
          <input type="text" class="form-control" name="titleEdit" value="{{$logo->title}}" required autofocus>
          @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
          @endif
        </div>

        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          <label for="description" class="control-label">Deskripsi</label>
          <textarea cols="10" rows="5" name="descriptionEdit" class="form-control">{{$logo->description}}</textarea>
          @if ($errors->has('description'))
              <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
              </span>
          @endif
        </div>

        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm">update</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>

      </form>
    </div>
      
    </div>
  </div>
</div>