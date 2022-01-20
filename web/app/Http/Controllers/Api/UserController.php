<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザー一覧を取得する
     *
     * @return User
     */
    public function index()
    {
        $query = User::with(['photos'])->withCount(['likePhotos']);
        $users = $query->orderBy(User::CREATED_AT, 'desc')->paginate();

        return UserResource::collection($users);
    }

    /**
     * ユーザー詳細を取得する
     *
     * @return User
     */
    public function show(String $id)
    {
        $user = User::with(['photos', 'likePhotos'])
            ->findOrFail($id);
        return new UserResource($user) ?? abort(404);
    }
}
