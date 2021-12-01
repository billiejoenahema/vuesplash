<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

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
}
