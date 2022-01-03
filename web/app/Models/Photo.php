<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $perPage = 6;

    /** JSONに含める属性 */
    protected $appends = [
        'url',
    ];

    /** JSONに含める属性 */
    protected $visible = [
        'id', 'user', 'url', 'comments', 'like_users', 'liked_by_user'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'filename',
    ];

    /**
     * 紐づくユーザーを取得。
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * アクセサ - url
     * @return string
     */
    public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->attributes['filename']);
    }

    /**
     * 紐づくコメントを取得。
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * フォトにいいねしているユーザーを取得。
     */
    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * アクセサ - url
     * @return string
     */
    public function getLikedByUserAttribute()
    {
        if (Auth::guest()) {
            return false;
        }

        return $this->likeUsers->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
