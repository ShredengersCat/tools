<?php
namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUser()
    {
        return User::all();
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function createUser(array $userDetails)
    {
        return User::firstOrCreate($userDetails);
    }

    public function updateUser($userId, array $userDetails)
    {
        return User::whereId($userId)->update($userDetails);
    }

    public function deleteUser($userId)
    {
        User::destroy($userId);
    }
}
