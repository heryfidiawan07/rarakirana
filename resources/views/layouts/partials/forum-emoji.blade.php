<div class="emojiforum">
	@foreach($emojis as $emo)
		<div class="emoloop">
			@if(Auth::check())
				@if(Auth::user())
					<a href="/thread-like/{{$emo->id}}/thread/{{$thread->id}}">
						<img src="/emoji/{{$emo->emoji}}.gif" alt="{{$emo->emoji}}">
					</a>
				@endif
			@else
				<a href="/register">
					<img src="/emoji/{{$emo->emoji}}.gif" alt="{{$emo->emoji}}">
				</a>
			@endif

			<span style="margin-left: 2px;">{{$thread->likes->where('emoticon_id',$emo->id)->count()}}</span>
			<span data-mid="{{$emo->id}}" data-pid="{{$emo->id}}" type="button" data-toggle="modal" data-target="#usersvote_{{$emo->id}}" class="caret caretVotes" data-url="/emoji/{{$emo->id}}/get/{{$thread->id}}/thread-users-vote"></span>
			<p style="width: 35px; text-align: center;">{{$emo->emoji}}</p>

			<div id="usersvote_{{$emo->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
						
			      <div class="modal-body">
		      		<div class="text-center">
		      			<span id="userVote_{{$emo->id}}" style="font-size: 16px;">{{$emo->emoji}}</span>
								<img src="/emoji/{{$emo->emoji}}.gif" style="width: 25px; margin-top: -5px;">
							</div>
		        	<div class="form-group userVote_{{$emo->id}}">
		        			
		        	</div>
			      </div>
			      
			    </div>
			  </div>
			</div>
		</div>
	@endforeach
</div>