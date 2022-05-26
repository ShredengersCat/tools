<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(StoreRequest $request)
    {
        $category = $this->service->store($request->only('title'));
        return response()->json($category);
    }

    public function show($categoryId)
    {
        return response()->json($this->service->show($categoryId));
    }

    public function update(UpdateRequest $request, $categoryId)
    {
        $this->service->update($categoryId, $request->only('title'));
        return response()->json('Updated');
    }

    public function destroy($categoryId)
    {
        $this->service->delete($categoryId);
    }
}
