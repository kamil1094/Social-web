@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        

        <div class="col-md-7 col-md-offset-4">
           @include('posts.include.single')
        </div>
    </div>
</div>
@endsection