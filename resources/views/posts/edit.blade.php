@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6 col-md-offset-3">
        	<div class="panel panel-default">
        		<div class="panel-body">
		           <form method="POST" action="{{url('/posts/'.$post->id)}}">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="form-group{{ $errors->has('post_content') ? ' has-error' : ''}}">
			                            
			    		<textarea name="post_content" cols="80" rows="5" class="form-control" placeholder="Co Ci chodzi po głowie?" style="margin-bottom: 10px;">{{ $post->content }}</textarea>
			    		<button type="submit" class="btn btn-primary pull-right">Zapisz</button>

			    		@if ($errors->has('post_content'))
			       			<span class="help-block">
			            		<strong>{{ $errors->first('post_content') }}</strong>
			        		</span>
			    		@endif
						</div>
					</form>
				</div>
        	</div>
        </div>
    </div>
</div>
@endsection