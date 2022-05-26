<?php
namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getAllPosts() : Collection;
    public function getPostById(int $postId) : Post;
    public function createPost(array $data) : Post;
    public function updatePost(int $postId, array $data);
    public function deletePost(int $postId);
    public function getPostWithPagination(int $posts) : Collection;
    public function getRandomPosts(int $posts) : Collection;
    public function getLikedPosts(int $posts) : Collection;
    public function getRelatedPosts(Post $post, int $posts) : Collection;
}
