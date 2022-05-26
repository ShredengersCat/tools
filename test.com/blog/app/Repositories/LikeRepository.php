<?php

namespace App\Repositories;

use App\Interfaces\LikeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LikeRepository implements LikeRepositoryInterface
{
    public function likedPosts() : Collection
    {
        return auth()->user()->likedPosts;
    }

    public function deatachLikedPost(int $postId)
    {
        auth()->user()->LikedPosts()->detach($postId);
    }

    public function storeLike(int $postId)
    {
        auth()->user()->likedPosts()->toggle($postId);
    }
}
