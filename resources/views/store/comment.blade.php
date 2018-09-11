  
  @foreach($discus as $disc)
    <div class="comment"<?php if ($disc->user->status == 2) {echo "style='color:red;'";}?>>
      
      <div class="usercom">
        <a href="/user/{{$disc->user->slug}}">
          <img src="<?php if ($disc->user->img != null){ echo "/users/".$disc->user->img;}else if($disc->user->graph != null){echo $disc->user->graph;}else{echo $disc->user->avatar();} ?>" class="img-circle" alt="user" width="50">
        </a>
        <a href="/user/{{$disc->user->slug}}" class="user-disc"><b>{{$disc->user->name}}</b></a>
        @if(Auth::check())
          @if(Auth::user()->admin())
            @if($disc->user_id != Auth::user()->id)
              @if($disc->user->status != 2)
                <a href="/admin/user/{{$disc->user_id}}/banned" class="banned"><small>Banned User <span class="glyphicon glyphicon-exclamation-sign"></span></small></a>
              @endif
            @endif
          @endif
        @endif
      </div>

      <div class="descom descom-{{$disc->id}}">
        @if($disc->user->status == 2)
          #############################
        @else
          {!! nl2br($disc->description) !!}
        @endif
      </div>

      @if(Auth::check())
        @if(Auth::user()->id == $disc->user_id)
          <small class="pull-right btn btn-primary btn-xs comedit" data-id="{{$disc->id}}"><span class="glyphicon glyphicon-edit"></span> edit</small>
        @endif
      @endif
    
      @if($emoji->count())
        @if(Auth::check())
          @if(Auth::user())
            <span data-url="/discus-like/{{$disc->id}}" class="comlike glyphicon glyphicon-thumbs-up" id="{{$disc->id}}" style="color: blue;"></span>
          @endif
        @else
          <a href="/register"><span class="glyphicon glyphicon-thumbs-up"></span></a>
        @endif
        <span class="comcount_{{$disc->id}}" style="margin-left: 5px;">{{$disc->likes->count()}}</span>

        <span data-id="{{$disc->id}}" type="button" data-toggle="modal" data-target="#usersdiscuslikes_{{$disc->id}}" class="caret caretModal" data-url="/discus/{{$disc->id}}/get-user-like" style="margin-right: 15px;"></span>
      @endif

      @include('layouts.partials.modal-discus-like')

      <div class="collapse" id="disc-{{$disc->id}}">
        <div class="card card-body col-md-12">
        <hr>
          <form action="/disc-to-disc/{{$disc->id}}/disc" method="POST">
          {{csrf_field()}}
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <textarea rows="4" class="form-control" name="description" id="newcomdesc" 
                <?php
                  if (Auth::guest()) {
                    echo "disabled";
                  }
                ?>
              >{{ old('description') }}</textarea>
              @if ($errors->has('description'))
                <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-xs" id="newdisc" prod-id="{{$disc->id}}" com-url="/disc-to-disc/{{$disc->id}}/disc"
                <?php
                  if (Auth::guest()) {
                    echo "disabled";
                  }
                ?>
              ><span class="glyphicon glyphicon-send" aria-hidden="true"></span> kirim
              </button>
            </div>
          </form>

          

        </div>
      </div>

    </div>
  @endforeach
  
  <div class="row">
    <div class="col-xs-12">
      
      <div class="text-center">
        <small>{{$discus->links()}}</small>
      </div>

      @if(Auth::check())
        @if(Auth::user())
          <form action="/discusion/{{$store->id}}/shop" method="POST">
            {{csrf_field()}}
            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
              <label>Beri Tanggapan</label>
              <textarea rows="5" class="form-control" name="description" id="newdescription">{{ old('description') }}</textarea>
              @if ($errors->has('description'))
                <span class="help-block">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-sm" id="newdisc" prod-id="{{$store->id}}" com-url="/discusion/{{$store->id}}/store">
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span> kirim
              </button>
            </div>
          </form>
        @endif
      @else
        <div class="form-group">
          <textarea rows="5" class="form-control" disabled></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-sm" disabled>
            <span class="glyphicon glyphicon-send" aria-hidden="true"></span> kirim
          </button>
        </div>
      @endif
    </div>
  </div>
  