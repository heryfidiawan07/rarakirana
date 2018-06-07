<a class="btn btn-primary btn-xs" href="#" type="button"  data-toggle="modal" data-target=".modalchildEdit_{{$child->id}}">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
    <small> Edit</small>
    <span class="caret"></span>
</a>

<div class="modal fade modalchildEdit_{{$child->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header"><h5 class="text-center">Edit Kategori</h5></div>
        
        <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="/admin/forum/category/{{$child->id}}/update">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Nama Kategori</label>

                <div class="col-md-6">
                    <input id="category" type="text" class="form-control" name="category" value="{{$child->menu}}" required autofocus>

                    @if ($errors->has('category'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('parent_forum') ? ' has-error' : '' }}">
            <label for="parent_id" class="col-md-4 control-label">Menu Induk</label>

            <div class="col-md-6">
                <select name="parent_forum" class="form-control" required autofocus 
                <?php foreach ($parents as $parent) {
                    if ($parent->id == $child->id) {
                        echo "disabled";
                    }
                } ?>
                >
                <?php
                    foreach ($parents as $parent) {
                        if ($parent->id == $child->id) { ?>
                            <option value='0'>Kategori ini adalah kategori induk.</option>
                <?php   }else{ ?>
                            <option value='0'>Pilih kategori induk atau biarkan kosong</option>
                <?php   }
                    } 
                ?>
                <option value='0'>Pilih kategori induk atau biarkan kosong</option>
                  @if($categorys->count())
                    @foreach($induxs as $pilih)
                        @if($pilih->id == $child->id)
                            @continue
                        @else
                            <option value="{{$pilih->id}}">{{$pilih->menu}}</option>
                        @endif
                    @endforeach
                  @endif
                </select>

                @if ($errors->has('parent_forum'))
                    <span class="help-block">
                        <strong>{{ $errors->first('parent_forum') }}</strong>
                    </span>
                @endif
            </div>
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