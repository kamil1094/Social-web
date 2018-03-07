@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-6 col-md-offset-3">
        	<div class="panel panel-default">
        		<div class="panel-body">
		           <form method="POST" action="{{url('/comments/'.$comment->id)}}">
						{{ csrf_field() }}
						{{ method_field('PATCH') }}
						<div class="form-group{{ $errors->has('comment_content') ? ' has-error' : ''}}">
			                            
			    		<input name="comment_content" cols="60" rows="5" class="form-control" placeholder="Treść komentarza" value="{{$comment->content}}"style="margin-bottom: 10px;">
			    		<button type="submit" class="btn btn-primary pull-right">Zapisz</button>

			    		@if ($errors->has('comment_content'))
			       			<span class="help-block">
			            		<strong>{{ $errors->first('comment_content') }}</strong>
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