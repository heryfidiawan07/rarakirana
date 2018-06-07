<a class="btn btn-primary btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalChildEdit_{{$child->id}}">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    <small> Edit</small>
    <span class="caret"></span>
</a>

<div class="modal fade modalChildEdit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

    <div class="modal-header"><h5 class="text-center">Edit Menu</h5></div>
    
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="/admin/menu/{{$child->id}}/update">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('menu') ? ' has-error' : '' }}">
            <label for="menu" class="col-md-4 control-label">Nama Menu</label>

            <div class="col-md-6">
                <input id="menu" type="text" class="form-control" name="menu" value="{{$child->menu}}" required autofocus>

                @if ($errors->has('menu'))
                    <span class="help-block">
                        <strong>{{ $errors->first('menu') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
            <label for="parent_id" class="col-md-4 control-label">Menu Induk</label>

            <div class="col-md-6">
                <select name="parent_id" class="form-control" required autofocus 
                <?php foreach ($parents as $parent) {
                    if ($parent->id == $child->id) {
                        echo "disabled";
                    }
                } ?>
                >
                <?php
                    foreach ($parents as $parent) {
                        if ($parent->id == $child->id) { ?>
                            <option value='0'>Menu ini adalah menu induk.</option>
                <?php   }else{ ?>
                            <option value='0'>Pilih Menu Induk atau Biarkan Kosong</option>
                <?php   }
                    } 
                ?>
                  @if($menus->count())
                    @foreach($induxs as $pilih)
                        @if($pilih->id == $child->id)
                            @continue
                        @else
                            <option value="{{$pilih->id}}">{{$pilih->menu}}</option>
                        @endif
                    @endforeach
                  @endif
                </select>

                @if ($errors->has('parent_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('parent_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status" class="col-md-4 control-label">Setel Sebagai :</label>

            <div class="col-md-6 form-check" style="margin-top: 7px;">
              <label style="margin-right: 50px;">
                <input type="radio" name="forcont" value="contact">
                <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Kontak
              </label>
              <label style="margin-right: 50px;">
                <input type="radio" name="forcont" value="forum"
                <?php
                    if ($forum || $child->products->count()) {
                        echo "disabled";
                    }  
                ?>
                ><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Forum
              </label>
              <label>
                <input type="radio" name="forcont" value="setelan">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Setelan
              </label>
            </div>
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
      </form>
    </div>
      
    </div>
  </div>
</div>