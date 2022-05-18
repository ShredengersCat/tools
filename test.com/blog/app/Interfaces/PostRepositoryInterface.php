<?php
namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostById($postId);
    public function createPost(array $potDetails);
    public function updatePost($postId, array $postDetails);
    public function deletePost($postId);
}
