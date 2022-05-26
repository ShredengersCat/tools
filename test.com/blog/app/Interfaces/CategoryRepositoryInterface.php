<?php
namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function getAllCategories() : Collection;
    public function getCategoryById(int $categoryId) : Category;
    public function createCategory(array $data) : Category;
    public function updateCategory(int $categoryId, array $data);
    public function deleteCategory(int $categoryId);
}
