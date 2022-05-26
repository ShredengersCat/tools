<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUser() : Collection
    {
        return User::all();
    }

    public function getUserById(int $userId) : User
    {
        return User::findOrFail($userId);
    }

    public function createUser(array $data) : User
    {
        return User::firstOrCreate(['email' => $data['email']], $data);
    }

    public function updateUser(int $userId, array $userDetails)
    {
        User::whereId($userId)->update($userDetails);
    }

    public function deleteUser(int $userId)
    {
        User::destroy($userId);
    }
}
