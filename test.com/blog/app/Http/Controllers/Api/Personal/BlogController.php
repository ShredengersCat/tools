<?php

namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\Comment\StoreRequest;
use App\Models\Post;
use App\Service\BLogService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected BLogService $service;

    public function __construct(BLogService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function show(Post $post)
    {
        return response()->json($this->service->show($post));
    }

    public function storeComment(Post $post, StoreRequest $request)
    {
        $this->service->storeComment($post, $request->only('message'));
        return response()->json(['Comment created', $post->id]);
    }

    public function storeLike(Post $post)
    {
        $this->service->storeLike($post);
        return response()->json('Like created');
    }
}
