
@if(Auth::check())

	@if(! Auth::user()->likes->contains('comment_id', $comment->id))

		<form method="POST" action="{{url('/likes')}}">
		        {{ csrf_field() }}
		    <input type="hidden" name="comment_id" value="{{$comment->id}}">
		    <button type="submit" class="btn btn-primary btn-xs" style="margin-top: 15px;"><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;Like <span class="label label-info">{{ $comment->likes->count() }}</span></button>
		    @foreach($comment->likes as $like)
			{{ $like->user->name }}
			@endforeach

		</form>
	@else

		<form method="POST" action="{{url('/likes')}}">
		        {{ csrf_field() }}
		        {{ method_field('DELETE')}}
		    <input type="hidden" name="comment_id" value="{{$comment->id}}">
		    <button type="submit" class="btn btn-primary btn-xs" style="margin-top: 15px;"><span class="glyphicon glyphicon-thumbs-down"></span>&nbsp;DisLike <span class="label label-info">{{ $comment->likes->count() }}</span></button>
		    @foreach($comment->likes as $like)
			{{ $like->user->name }}
			@endforeach

		</form>

	@endif

@endif
