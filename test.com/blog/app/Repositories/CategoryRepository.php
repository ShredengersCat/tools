<?php
namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories() : Collection
    {
        return Category::all();
    }

    public function getCategoryById(int $categoryId) : Category
    {
        return Category::whereId($categoryId)->get()->first();
    }

    public function createCategory(array $data) : Category
    {
        return Category::firstOrCreate($data);
    }

    public function updateCategory(int $categoryId, array $data)
    {
        return Category::whereId($categoryId)->update($data);
    }

    public function deleteCategory(int $categoryId)
    {
        Category::destroy($categoryId);
    }
}
