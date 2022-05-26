<?php

namespace App\Http\Controllers\Api\Personal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Personal\Comment\UpdateRequest;
use App\Service\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function update(UpdateRequest $request, $commentId)
    {
        $this->service->update($commentId, $request->only('message'));
        return response()->json("Comment updated");
    }

    public function destroy($commentId)
    {
        $this->service->delete($commentId);
        return response()->json("Comment deleted");
    }
}
