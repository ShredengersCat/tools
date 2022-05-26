<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Service\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected TagService $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(StoreRequest $request)
    {
        $tag = $this->service->store($request->only('title'));
        return response()->json($tag);
    }

    public function show($tagId)
    {
        return response()->json($this->service->show($tagId));
    }

    public function update(UpdateRequest $request, $tagId)
    {
        $this->service->update($tagId, $request->only('title'));
        return response()->json("Tag Updated");
    }

    public function destroy($tagId)
    {
        $this->service->delete($tagId);
        return response()->json("Tag Deleted");
    }
}
