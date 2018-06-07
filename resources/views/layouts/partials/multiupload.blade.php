<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#file" aria-controls="file" role="tab" data-toggle="tab">Upload Gambar <small><i><u>maksimal 5 gambar</u></i></small></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="file"><br>
    	<input type="file" name="img[]" class="form-control" multiple="multiple">
    </div>
  </div>
  @if($errors->has('img'))
      <span class="help-block"> {{$errors->first('img')}} </span>
  @endif