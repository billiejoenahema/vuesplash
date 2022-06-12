<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * コメントを投稿する。
     *
     * @param CommentStoreRequest $request
     * @return JsonResponse
     */
    public function create(CommentStoreRequest $request, Int $id)
    {
        $comment = Comment::create([
            'content' => $request['content'],
            'user_id' => Auth::user()->id,
            'photo_id' => $id,
        ]);

        return new CommentResource($comment);
    }
}
