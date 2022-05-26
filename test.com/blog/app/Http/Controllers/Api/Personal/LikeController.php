<?php

namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;
use App\Service\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    protected LikeService $service;

    public function __construct(LikeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }
    public function destroy($postId)
    {
        $this->service->destroy($postId);
        return response()->json("Like deleted");
    }
}
