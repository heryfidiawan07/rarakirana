<a class="btn btn-primary btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalMenuEdit_{{$menu->id}}">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    <small> Edit</small>
    <span class="caret"></span>
</a>

<div class="modal fade modalMenuEdit_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <div class="modal-header"><h5 class="text-center">Edit Menu</h5></div>
    
    <div class="modal-body">
      <form class="form-horizontal" role="form" method="POST" action="/admin/menu/{{$menu->id}}/update">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('menu') ? ' has-error' : '' }}">
            <label for="menu" class="col-md-4 control-label">Nama Menu</label>

            <div class="col-md-6">
                <input id="menu" type="text" class="form-control" name="menu" value="{{$menu->menu}}" required autofocus>

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
                    if ($parent->id == $menu->id) {
                        echo "disabled";
                    }
                } ?>
                >
                <?php
                    foreach ($parents as $parent) {
                        if ($parent->id == $menu->id) { ?>
                            <option value='0'>Menu ini adalah menu induk.</option>
                <?php   }else{ ?>
                            <option value='0'>Pilih Menu Induk atau Biarkan Kosong</option>
                <?php   }
                    } 
                ?>
                <option value='0'>Pilih Menu Induk atau Biarkan Kosong</option>
                  @if($menus->count())
                    @foreach($induxs as $pilih)
                        @if($pilih->id == $menu->id)
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
                <input type="radio" name="forcont" value="contact"
                <?php
                    if ($menu->forum == 1) {
                        echo "disabled";
                    }  
                ?>
                >
                <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Kontak
              </label>
              <label style="margin-right: 50px;">
                <input type="radio" name="forcont" value="forum"
                <?php
                    if ($forum || $menu->products->count() ) {
                        echo "disabled";
                    }  
                ?>
                ><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Forum
              </label>
              <label>
                <input type="radio" name="forcont" value="setelan"
                <?php
                    if ($menu->forum == 1) {
                        echo "disabled";
                    }  
                ?>
                >
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