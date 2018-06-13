@if($user->admin != 1)
  @if($user->status == 1)
    <a class="btn btn-success btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modaluserStatus_{{$user->id}}">
      <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
      <small> Aktif</small>
      <span class="caret"></span>
    </a>
  @else
    <a class="btn btn-danger btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modaluserStatus_{{$user->id}}">
      <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
      <small> Tidak Aktif</small>
      <span class="caret"></span>
    </a>
  @endif


  <div class="modal fade modaluserStatus_{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header"><h5 class="text-center">Ubah Status User</h5></div>
        
        <div class="modal-body">
          <div class="form-group">
            <div class="text-center">
              <form method="user" action="/admin/user/{{$user->id}}/status">
              {{ csrf_field() }}
                  <button name="status" value="1" type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> Set Aktif</button>
                  <button name="status" value="0" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Set Tidak Aktif</button>
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endif