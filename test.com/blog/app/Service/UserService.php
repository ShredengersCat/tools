<?php
namespace App\Service;

use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index() : Collection
    {
        return $this->userRepository->getAllUser();
    }

    public function store(array $data) : User
    {
        $password = Str::random(10);
        $data['password'] = Hash::make($password);
        $user = $this->userRepository->createUser($data);
        Mail::to($data['email'])->send(new PasswordMail($password));
        event(new Registered($user));
        return $user;
    }

    public function show(int $userId) : User
    {
        return $this->userRepository->getUserById($userId);
    }

    public function update(int $userId, array $data)
    {
        $this->userRepository->updateUser($userId, $data);
    }

    public function delete(int $userId)
    {
        $this->userRepository->deleteUser($userId);
    }
}
