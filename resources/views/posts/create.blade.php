<form method="POST" action="{{url('/posts')}}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('post_content') ? ' has-error' : ''}}">

	    <textarea name="post_content" cols="80" rows="5" class="form-control" placeholder="What's on your mind?" style="margin-bottom: 10px;">{{ old('post_content') }}</textarea>
	    <button type="submit" class="btn btn-default pull-right">Post</button>

	    @if ($errors->has('post_content'))
	        <span class="help-block">
	            <strong>{{ $errors->first('post_content') }}</strong>
	        </span>
	    @endif
	</div>
</form>
