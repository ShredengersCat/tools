<?php
namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUser() : Collection;
    public function getUserById(int $userId) : User;
    public function createUser(array $data) : User;
    public function updateUser(int $userId, array $data);
    public function deleteUser(int $userId);
}
