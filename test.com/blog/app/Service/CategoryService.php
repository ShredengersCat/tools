<?php
namespace App\Service;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app()->make(CategoryRepository::class);
    }

    public function index() : Collection
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store(array $data) : Category
    {
        return $this->categoryRepository->createCategory($data);
    }

    public function show(int $categoryId) : Category
    {
        return $this->categoryRepository->getCategoryById($categoryId);
    }

    public function update(int $categoryId, array $data)
    {
        return $this->categoryRepository->updateCategory($categoryId, $data);
    }

    public function delete(int $categoryId)
    {
        $this->categoryRepository->deleteCategory($categoryId);
    }
}
