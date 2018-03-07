@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <a href="{{ url('/users/' . $user->id) }}">
            <div class="media col-md-3">
              <div class="media-left media-middle">
                  <img class="media-object" src="{{ url('user-avatar/' . $user->id . '/40') }}" alt="...">
              </div>
              <div class="media-body">
                <h3 class="media-heading" style="padding-top: 6px;">{{ $user->name }}</h3>
              </div>
            </div>
        </a>
            
            <div class="col-md-7">
                @if(Auth::check())
                    <div class="panel panel-default">
                        <div class="panel-body">

                                @include('posts.create')

                        </div>
                    </div>
                @endif
            </div>
           
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-3">


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