<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'username' => $this->username,
            'avatar' => $this->avatar,
            'articles' => $this->articlesCount,
            'is_followed' => $this->isFollowed,
            'followers' => $this->followerCount,
            'following' => $this->followingCount,
            'created_at' => $this->created_at
        ];
    }
}
