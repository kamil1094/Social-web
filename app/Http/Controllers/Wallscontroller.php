<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;


class Wallscontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

    	$user = User::findOrFail(Auth::user());
    	$friends = Auth::user()->friends();
    	$friends_ids_array = [];
    	$friends_ids_array[] = Auth::id();

    	foreach($friends as $friend)
    	{
    		$friends_ids_array[] = $friend->id;
    	}
        if(is_admin())
        {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id', $friends_ids_array)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate(4);
        }

    	   $posts = Post::with('comments.user')
            ->with('likes')
            ->with('comments.likes')
            ->whereIn('user_id', $friends_ids_array)
    	    ->orderBy('created_at', 'desc')
            ->withTrashed()
    	    ->paginate(4);

    	return view('walls.index', compact('posts', 'user'));
    }
}
