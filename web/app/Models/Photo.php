<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    use HasFactory;

    protected $perPage = 1;

    /** JSONに含める属性 */
    protected $appends = [
        'url',
    ];

    /** JSONに含める属性 */
    protected $visible = [
        'id', 'user', 'url', 'comments',
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
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * フォトにいいねしているユーザーを取得。
     */
    public function likeUsers()
    {
        return $this->hasMany('App\Models\User', 'like', 'user_id', 'photo_id');
    }
}
