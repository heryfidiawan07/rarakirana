<a class="btn btn-primary btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalLogoImg_{{$logo->id}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit <span class="caret"></span></a>

<div class="modal fade modalLogoImg_{{$logo->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

    <div class="modal-header"><h5 class="text-center">Edit Logo</h5></div>
    
    <div class="modal-body" style="padding: 20px;">
      <form class="form-horizontal" role="form" method="POST" action="/admin/logo/{{$logo->id}}/updateImg" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
          <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#file" aria-controls="file" role="tab" data-toggle="tab">Upload Gambar</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="file"><br>
                  <input type="file" class="form-control" name="logoEdit">
              </div>
            </div>

          @if ($errors->has('img'))
              <span class="help-block">
                  <strong>{{ $errors->first('img') }}</strong>
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