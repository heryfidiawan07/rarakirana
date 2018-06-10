@foreach($comments as $comment)
  <div class="comment"<?php if ($comment->user->status == 2) {echo "style='color:red;'";}?>>
    <div class="usercom">
      <a href="/user/{{$comment->user->slug}}" class="user-comment">
        <img src="<?php if ($comment->user->img != null){ echo "/users/".$comment->user->img;}else if($comment->user->graph != null){echo $comment->user->graph;}else{echo $comment->user->avatar();} ?>" class="img-circle" alt="user" width="50">
      </a>
      <a href="/user/{{$comment->user->slug}}" class="user-comment"><b>{{$comment->user->name}}</b></a>
      @if(Auth::check())
        @if(Auth::user()->admin())
          @if($comment->user_id != Auth::user()->id)
            @if($comment->user->status != 2)
              <a href="/admin/user/{{$comment->user_id}}/banned" class="banned"><small>Banned User <span class="glyphicon glyphicon-exclamation-sign"></span></small></a>
            @endif
          @endif
        @endif
      @endif
    </div>
    <div class="descom descom-{{$comment->id}}">
      @if($comment->user->status == 2)
        #############################
      @else
        {!! nl2br($comment->description) !!}
      @endif
    </div>
    @if(Auth::check())
      @if(Auth::user()->id == $comment->user_id)
        <small class="pull-right btn btn-primary btn-xs comedit" data-id="{{$comment->id}}"><span class="glyphicon glyphicon-edit"></span> edit</small>
      @endif
    @endif

    @if(Auth::check())
      @if(Auth::user())
        <span data-url="/comment-like/{{$comment->id}}" class="comlike glyphicon glyphicon-thumbs-up" id="{{$comment->id}}" style="color: blue;"></span>
      @endif
    @else
      <a href="/register"><span class="glyphicon glyphicon-thumbs-up"></span></a>
    @endif
    <span class="comcount_{{$comment->id}}" style="margin-left: 5px;">{{$comment->likes->count()}}</span>

    <span data-id="{{$comment->id}}" type="button" data-toggle="modal" data-target="#userscommentlikes_{{$comment->id}}" class="caret caretModal" data-url="/comment/{{$comment->id}}/get-user-like" style="margin-right: 15px;"></span>
    
    @include('layouts.partials.modal-comment-like')

      <div class="collapse" id="comment-{{$comment->id}}">
        <div class="card card-body col-md-12">
        <hr>
          <form action="/comment-to-comment/{{$comment->id}}/comment" method="POST">
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
              <button type="submit" class="btn btn-primary btn-xs" id="newcomment" prod-id="{{$comment->id}}" com-url="/comment-to-comment/{{$comment->id}}/comment"
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
      <small>{{$comments->links()}}</small>
    </div>
    
    @if(Auth::check())
      @if(Auth::user())
        <form action="/comment/{{$thread->id}}/thread" method="POST">
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
            <button type="submit" class="btn btn-primary btn-sm" id="newcomment" prod-id="{{$thread->id}}" com-url="/comment/{{$thread->id}}/thread">
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