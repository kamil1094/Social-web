<div class="row">
    <div class="col-md-12">
		<form method="POST" action="{{url('/comments')}}">
			{{ csrf_field() }}

			<div class="pull-left">
				<img src="{{ url('user-avatar/'.Auth::id().'/35') }}" alt="" class="img-responsive">
			</div>

			<div class="col-xs-11">
				<div class="form-group{{ $errors->has('post_' . $post->id . '_comment_content') ? ' has-error' : ''}}">

				    <input name="post_{{ $post->id }}_comment_content" class="form-control" placeholder="Write a comment..." value="{{ old('post_' . $post->id . '_comment_content') }}">
				    <input type="hidden" name="post_id" value="{{$post->id}}"></br>
				    <button type="submit" class="btn btn-default btn-small pull-right">Post comment</button>
				    @if ($errors->has('post_' . $post->id . '_comment_content'))
				        <span class="help-block">
				            <strong>{{ $errors->first('post_' . $post->id . '_comment_content') }}</strong>
				        </span>
				    @endif

				</div>
			</div>
		</form>

	</div>
</div>
