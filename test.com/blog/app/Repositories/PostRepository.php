<?php
namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::all();
    }

    public function getPostById($postId)
    {
        return Post::findOrFail($postId);
    }

    public function createPost(array $postDetails)
    {
        return Post::firstOrCreate($postDetails);
    }

    public function updatePost($postId, array $postDetails)
    {
        return Post::whereId($postId)->update($postDetails);
    }

    public function deletePost($postId)
    {
        Post::destroy($postId);
    }
}
