<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * フォトにいいねする
     *
     * @param string $id
     * @return array
     */
    public function like(string $id)
    {
        $photo = Photo::with('likeUsers')->findOrFail($id);
        $photo->likeUsers()->detach(Auth::user()->id);
        $photo->likeUsers()->attach(Auth::user()->id);

        return ["photo_id" => $id];
    }

    /**
     * いいねを解除する
     *
     * @param string $id
     * @return array
     */
    public function dislike(string $id)
    {
        $photo = Photo::with('likeUsers')->findOrFail($id);
        $photo->likeUsers()->detach(Auth::user()->id);

        return ["photo_id" => $id];
    }
}
