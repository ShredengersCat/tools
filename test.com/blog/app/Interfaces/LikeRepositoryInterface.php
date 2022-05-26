<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface LikeRepositoryInterface
{
    public function likedPosts() : Collection;
    public function storeLike(int $postId);
    public function deatachLikedPost(int $postId);
}
