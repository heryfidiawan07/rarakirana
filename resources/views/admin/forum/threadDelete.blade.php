<a id="delete" href="#" type="button"  data-toggle="modal" data-target=".modalthreadDestroy_{{$thread->id}}">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    <small> Hapus ?</small>
    <span class="caret"></span>
</a>

<div class="modal fade modalthreadDestroy_{{$thread->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header"><h5 class="text-center">Hapus Thread</h5></div>
        
        <div class="modal-body">
            <div class="form-group">
                <div class="text-center">
                    <a href="/admin/thread/{{$thread->id}}/destroy" type="submit" class="btn btn-danger btn-sm">Hapus !</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
      
    </div>
  </div>
</div>