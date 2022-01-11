<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** JSONに含める属性 */
    protected $visible = [
        'id', 'name', 'photos', 'likePhotos'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 紐づくフォトを取得。
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

    /**
     * ユーザーがいいねしたフォトを取得。
     */
    public function likePhotos()
    {
        return $this->belongsToMany(Photo::class, 'likes');
    }
}
