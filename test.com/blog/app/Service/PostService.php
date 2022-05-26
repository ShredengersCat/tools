<?php
namespace App\Service;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index() : Collection
    {
        return $this->postRepository->getAllPosts();
    }

    public function store(array $data, array $tagIds = null) : Post
    {
        try {
            DB::beginTransaction();
            $data = $this->saveImage($data);
            $post = $this->postRepository->createPost($data);
            if (count($tagIds) > 0) {
                $post->tags()->attach($tagIds);
            }
            DB::commit();
            return $post;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function show(int $postId) : Post
    {
        return $this->postRepository->getPostById($postId);
    }

    public function update(array $data, array $tagIds, Post $post) : Post
    {
        try {
            DB::beginTransaction();
            $data = $this->saveImage($data);
            $this->postRepository->updatePost($post->id, $data);
            if (count($tagIds) > 0) {
                $post->tags()->sync($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
        return $post;
    }

    public function saveImage(array $data) : array
    {
        if (isset($data['preview_image'])) {
            $data['preview_image'] = Storage::put('/images', $data['preview_image']);
        }
        if (isset($data['main_image'])) {
            $data['main_image'] = Storage::put('/images', $data['main_image']);
        }
        return $data;
    }

    public function delete(Post $post)
    {
        $post->tags()->detach();
        $this->postRepository->deletePost($post->id);
    }
}
