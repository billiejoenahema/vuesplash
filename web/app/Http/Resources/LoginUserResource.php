<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginUserResource extends JsonResource
{
    /**
     * 適用する「データ」ラッパー
     *
     * @var string
     */
    public static $wrap = 'login_user';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y/m/d H:i:s'),
        ];
    }
}
