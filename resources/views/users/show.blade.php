@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        @include('layouts.sidebar')

        <div class="col-md-7">

            @if(Auth::check() && $user->id === Auth::id())
                <div class="panel panel-default">
                    <div class="panel-body">

                            @include('posts.create')

                    </div>
                </div>
            @endif

           @foreach($posts as $post)                
                @include('posts.include.single')
            @endforeach

            <div class="text-center">
                {{ $posts }}
            </div>
           
        </div>
    </div>
</div>
@endsection