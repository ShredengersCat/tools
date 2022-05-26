<?php
namespace App\Service;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\LikeRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Carbon\Carbon;

class BLogService
{
    protected PostRepositoryInterface $postRepository;
    protected CommentRepositoryInterface $commentRepository;
    protected LikeRepositoryInterface $likeRepository;

    public function __construct(PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository, LikeRepositoryInterface $likeRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
        $this->likeRepository = $likeRepository;
    }

    public function index() : array
    {
        $data = [];
        $data['posts'] = $this->postRepository->getPostWithPagination(6);
        $data['randomPosts'] = $this->postRepository->getRandomPosts(4);
        $data['likedPosts'] = $this->postRepository->getLikedPosts(4);

        return $data;
    }

    public function show(Post $post) : array
    {
        $data = [];
        $data['date'] = Carbon::parse($post->created_at);
        $data['relatedPosts'] = $this->postRepository->getRelatedPosts($post,3);
        return $data;
    }

    public function storeComment(Post $post, array $data)
    {
        $data['post_id'] = $post->id;
        $data['user_id'] = auth()->user()->id;

        $this->commentRepository->storeComment($data);
    }

    public function storeLike(Post $post)
    {
        $this->likeRepository->storeLike($post->id);
    }
}
