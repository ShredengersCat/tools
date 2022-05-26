<?php
namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts() : Collection
    {
        return Post::all();
    }

    public function getPostById($postId) : Post
    {
        return Post::findOrFail($postId);
    }

    public function createPost(array $data) : Post
    {
        return Post::firstOrCreate($data);
    }

    public function updatePost($postId, array $data)
    {
        Post::whereId($postId)->update($data);
    }

    public function deletePost($postId)
    {
        Post::destroy($postId);
    }

    public function getPostWithPagination(int $posts): Collection
    {
        return Post::paginate($posts);
    }

    public function getRandomPosts(int $posts): Collection
    {
        return Post::get()->random($posts);
    }

    public function getLikedPosts(int $posts): Collection
    {
        return Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->get()->take($posts);
    }

    public function getRelatedPosts(Post $post, int $posts): Collection
    {
        return Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take($posts);
    }
}
