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
    public function create(Comment $comment, CommentStoreRequest $request)
    {
        $comment->content = $request['content'];
        $comment->user_id = Auth::user()->id;
        $comment->photo_id = $request['photo_id'];

        return response(201);
    }
}
