<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメント投稿
     * @param Comment $comment
     * @param CommentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function create(Comment $comment, CommentStoreRequest $request, Int $id)
    {
        $comment = Comment::create([
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
            'photo_id' => $id,
        ]);

        return response($comment);
    }
}
