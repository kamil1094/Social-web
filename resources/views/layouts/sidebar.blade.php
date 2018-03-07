<div class="col-md-3 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
                    User
                    @if($user->id === Auth::id())
                    <a href="{{ url('users/' . $user->id . '/edit')}}" class="pull-right"><small>Edit</small></a>
                    @endif
        </div>

        <div class="panel-body text-center">

            <img src="{{ url('user-avatar/' . $user->id . '/250') }}" alt="nie działa" class="img-responsive center-block thumbnail">
            <h2><a href="{{ url('/users/' . $user->id) }}">{{ $user->name }}</a></h2>
            <p>
            @if ($user->sex == 'm')
                Male
            @else
                Female
            @endif
            </p>
            <p>{{ $user->email }}</p>
            <p><a href="{{url('/users/' . $user->id . '/friends')}}">Friends</a> <span class="label label-default">{{$user->friends()->count()}}</span></p>

            @if ($user->id !== Auth::id() && Auth::id())

                @if(!friendship($user->id)->exists && !has_friend_invitation($user->id))

                <form method="POST" action="{{ url('/friends/'.$user->id) }}">
                    {{ csrf_field() }}
                    <button class="btn btn-success">Invite</button>
                </form>

                @elseif (has_friend_invitation($user->id))

                <form method="POST" action="{{ url('/friends/'.$user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH')}}
                    <button class="btn btn-primary">Confirm</button>
                </form>

                @elseif (friendship($user->id)->exists && !friendship($user->id) ->accepted)

                    <button disabled class="btn btn-success disabled">invitation sent</button>

                @elseif (friendship($user->id)->exists && friendship($user->id) ->accepted)

                    <form method="POST" action="{{ url('/friends/'.$user->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}
                    <button class="btn btn-danger">Delete friendship</button>
                </form>

                @endif
            @endif


        </div>
    </div>
</div>
