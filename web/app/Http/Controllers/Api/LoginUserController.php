<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\LoginUserResource;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    /**
     * ログインユーザーの情報を返す。
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $login_user = User::findOrFail(Auth::id());
        return new LoginUserResource($login_user);
    }
}
