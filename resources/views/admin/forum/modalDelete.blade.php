<a class="btn btn-danger btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalcategoryDestroy_{{$category->id}}">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    <small> Hapus ?</small>
    <span class="caret"></span>
</a>

<div class="modal fade modalcategoryDestroy_{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header"><h5 class="text-center">Hapus category</h5></div>
        
        <div class="modal-body">
            <div class="form-group">
                <div class="text-center">
                    <a href="/admin/forum/category/{{$category->id}}/destroy" type="submit" class="btn btn-danger btn-sm">Hapus !</a>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
      
    </div>
  </div>
</div>