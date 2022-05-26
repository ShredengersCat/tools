<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Service\CategoryService;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryServiceTest extends TestCase
{
    public function testGetAllCategories()
    {
        $category = Category::factory()->count(5)->make();
        $categoryCollection = Collection::make($category);
        app()->instance(
            CategoryRepository::class,
            Mockery::mock(CategoryRepository::class, function (MockInterface $mock) use ($categoryCollection){
                $mock
                    ->shouldReceive('getAllCategories')
                    ->once()
                    ->andReturn($categoryCollection);
            })->makePartial()
        );
        $categoryService = app()->make(CategoryService::class);
        $this->assertEquals(
            $categoryCollection,
            $categoryService->index()
        );
    }

    public function testGetCategoryById()
    {
        $category = Category::factory()->make();
        app()->instance(
            CategoryRepository::class,
            Mockery::mock(CategoryRepository::class, function (MockInterface $mock) use ($category){
                $mock->shouldReceive('getCategoryById')
                    ->once()
                    ->andReturn($category);
            })->makePartial()
        );
        $cateogryService = app()->make(CategoryService::class);
        $this->assertEquals(
            $category,
            $cateogryService->show($category->id)
        );
    }

    public function testCategoryCreate()
    {
        $category = Category::factory()->make();
        app()->instance(
            CategoryRepository::class,
            Mockery::mock(CategoryRepository::class, function (MockInterface $mock) use ($category){
                $mock
                    ->shouldReceive('createCategory')
                    ->once()
                    ->with($category->toArray())
                    ->andReturn($category);
            })->makePartial()
        );
        $studentService = app()->make(CategoryService::class);
        $this->assertEquals(
            $category,
            $studentService->store($category->toArray())
        );
    }

    public function testCategoryUpdate()
    {
        $category = Category::factory()->make();
        app()->instance(
            CategoryRepository::class,
            Mockery::mock(CategoryRepository::class, function (MockInterface $mock) use ($category){
                $mock
                    ->shouldReceive('updateCategory')
                    ->once()
                    ->with($category->id, $category->toArray())
                    ->andReturn(0);
            })->makePartial()
        );
        $studentService = app()->make(CategoryService::class);
        $this->assertEquals(
            0,
            $studentService->update($category->id, $category->toArray())
        );
    }

    public function testCategoryDelete()
    {
        $category = Category::factory()->make();
        app()->instance(
            CategoryRepository::class,
            Mockery::mock(CategoryRepository::class, function (MockInterface $mock) use ($category){
                $mock
                    ->shouldReceive('deleteCategory')
                    ->once()
                    ->with($category->id)
                    ->andReturn(0);
            })->makePartial()
        );
        $studentService = app()->make(CategoryService::class);
        $this->assertEquals(
            0,
            $studentService->delete($category->id)
        );
    }
}
