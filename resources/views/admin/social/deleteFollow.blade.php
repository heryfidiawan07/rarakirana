<a class="btn btn-danger btn-xs" href="#" type="button" data-toggle="modal" data-target=".deleteFollow_{{$follow->id}}">
  <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
  <small> Hapus ? </small>
  <span class="caret"></span>
</a>

<div class="modal fade deleteFollow_{{$follow->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header"><h5 class="text-center">Hapus Sosial Media Follow</h5></div>
      
      <div class="modal-body">
        <div class="form-group">
          <div class="text-center">
              <a href="/admin/follow/{{$follow->id}}/destroy" class="btn btn-danger">Hapus !</a>
              <a type="button" href="#" class="btn btn-default" data-dismiss="modal">Batal</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>