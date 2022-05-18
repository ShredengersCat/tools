<?php
namespace App\Service;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Tag;
use App\Models\User;

class AdminService
{
    protected CategoryRepositoryInterface $categoryRepository;
    protected PostRepositoryInterface $postRepository;
    protected UserRepositoryInterface $userRepository;
    protected TagRepositoryInterface $tagRepository;

    public function __construct($categoryRepository, $postRepository, $userRepository, $tagRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $data = [];
        $data['usersCount'] = $this->userRepository->getAllUser()->count();
        $data['postsCount'] = $this->postRepository->getAllPosts()->count();
        $data['categoriesCount'] = $this->categoryRepository->getAllCategories()->count();
        $data['tagsCount'] = $this->tagRepository->getAllTag()->count();
        return $data;
    }
}
