@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Notifications
                </div>
                <div class="panel-body">
                    @if(Auth::user()->notifications->count() === 0 )
                        <h4 class="text-center">Nothing interesting</h4>
                    @else

                    <ul class="list-group">

                        @foreach(Auth::user()->notifications as $notification)

                            <li class="list-group-item">
                                @if(isset($notification->data['message1']))
                                    {{ $notification->data['message']}}
                                    <a href="{{ url('users/' . $notification->data['from_user_id']) }}">{{$notification->data['from_user_name']}}</a>
                                    {{ $notification->data['message1']}}
                                @endif

                                @if(isset($notification->data['zn']))
                                    {{ $notification->data['message']}}
                                    <a href="{{ url('users/' . $notification->data['from_user_id']) }}">{{$notification->data['from_user_name']}}</a>
                                @endif

                                @if(isset($notification->data['zn1']))
                                    <?= html_entity_decode($notification->data['message']) ?>
                                @endif


                                @if(isset($notification->data['message3']) && Auth::user()->id == $notification->data['from_user_id'])

                                {{ $notification->data['message3']}}
                                <a href="{{ url('/posts/' . $notification->data['post_id'] . '#comment_' . $notification->data['comment_id']) }}">post</a>

                                @endif

                                @if(isset($notification->data['message2']) && Auth::user()->id != $notification->data['from_user_id'])
                                    {{ $notification->data['message']}}
                                    <a href="{{ url('users/' . $notification->data['from_user_id']) }}">{{$notification->data['from_user_name']}}</a>
                                    {{ $notification->data['message2']}}
                                    <a href="{{ url('/posts/' . $notification->data['post_id'] . '#comment_' . $notification->data['comment_id']) }}">post</a>

                                @endif

                                @if(is_null($notification->read_at))
                                    <form method="POST" action="{{url('/notifications/' . $notification->id)}}" class="pull-right">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}

                                        <button type="submit" class="btn btn-primary btn-xs pull-right">Mark as read</button>
                                    </form>
                                @else
                                    <button type="submit" disabled class="btn btn-disabled btn-xs pull-right">Read</button>

                                @endif

                            </li>
                        @endforeach

                    </ul>



                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
