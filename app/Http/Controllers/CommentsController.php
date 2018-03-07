<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\User;
use App\Post;
use App\Notifications\PostCommented;


class CommentsController extends Controller
{
    public function __contstruct()
    {
        $this->middleware('comment_permission', ['except' => ['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        $post_id_comment_content = 'post_' . $request->post_id . '_comment_content';

         $this->validate($request, [
            'post_' . $request->post_id . '_comment_content' => 'required|min:2'
            ]);

        $comment = Comment::create([
                'post_id' => $request->post_id,
                'user_id' => Auth::id(),
                'content' => $request->$post_id_comment_content,
            ]);

        
        User::findOrFail($post->user_id)->notify(new PostCommented($request->post_id, $comment->id));

        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comment_content' => 'required|min:1'
            ]);
        Comment::where('id', $id)->withTrashed()->update([
                'content' => $request->comment_content,
            ]);

        return redirect('/wall');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Comment::where(['id' => $id])->delete();

        return back();
    }
}
