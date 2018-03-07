@if(Auth::check())

	@if(! Auth::user()->likes->contains('post_id', $post->id))

		<form method="POST" action="{{url('/likes')}}">
		        {{ csrf_field() }}
		    <input type="hidden" name="post_id" value="{{$post->id}}">
		    <button type="submit" class="btn btn-primary btn-xs" style="margin-top: 15px;">
					<span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;Like <span class="label label-info">{{ $post->likes->count() }}</span>
				</button>
		</form>

	@else

		<form method="POST" action="{{url('/likes')}}">
		        {{ csrf_field() }}
		        {{ method_field('DELETE')}}
		    <input type="hidden" name="post_id" value="{{$post->id}}">
				<button type="submit" class="btn btn-primary btn-xs" style="margin-top: 15px;">
					<span class="glyphicon glyphicon-thumbs-up"></span >&nbsp;Like <span class="label label-info">{{ $post->likes->count() }}</span>
				</button>


		</form>

	@endif

@endif
