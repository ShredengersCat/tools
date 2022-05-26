<?php

namespace App\Service;

use App\Interfaces\LikeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LikeService
{
    protected LikeRepositoryInterface $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function index() : Collection
    {
        return $this->likeRepository->likedPosts();
    }

    public function destroy($postId)
    {
        $this->likeRepository->deatachLikedPost($postId);
    }
}
