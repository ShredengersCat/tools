<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->index());
    }

    public function store(StoreRequest $request)
    {
        $user = $this->service->store($request->only('name', 'email', 'role'));
        return response()->json($user);
    }

    public function show($userId)
    {
        return response()->json($this->service->show($userId));
    }

    public function update(UpdateRequest $request, $userId)
    {
        $this->service->update($userId, $request->only('name', 'email', 'role'));
        return response()->json("User updated");
    }

    public function destroy($userId)
    {
        $this->service->delete($userId);
        return response()->json("User deleted");
    }
}
