<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use App\Service\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(StoreRequest $request)
    {
        $data = $request->only('title', 'content', 'preview_image', 'main_image', 'category_id');
        $post = $this->service->store($data, $request->only('tag_ids'));
        return response()->json($post);
    }

    public function show($postId)
    {
        return response()->json($this->service->show($postId));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->only('title', 'content', 'preview_image', 'main_image', 'category_id');
        $post = $this->service->update($data, $request->only('tag_ids'), $post);
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $this->service->delete($post);
        return response()->json("Post deleted");
    }
}
