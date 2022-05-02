<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }

    public function test_category_index()
    {
        $response = $this->actingAs($this->user)->get(route('admin.category.index'));

        $response->assertStatus(200);
    }

    public function test_category_create()
    {
        $response = $this->actingAs($this->user)->get(route('admin.category.create'));

        $response->assertStatus(200);
    }

    public function test_category_store()
    {
        $this
            ->actingAs($this->user)
            ->withHeaders(['Accept' => '/application/json'])
            ->post(route('admin.category.store'), [$this->category]);

        $this->assertDatabaseHas('categories', [
            'title' => 'Some category'
        ]);
    }

    public function test_category_show()
    {
        $response = $this->actingAs($this->user)->get(route('admin.category.show', $this->category->id));

        $response->assertStatus(200);
    }

    public function test_category_edit()
    {
        $response = $this->actingAs($this->user)->get(route('admin.category.edit', $this->category->id));

        $response->assertStatus(200);
    }

    public function test_category_update()
    {
        $response = $this
            ->actingAs($this->user)
            ->patch('admin/category/' . $this->category->id, [$this->category]);

        $response->assertStatus(302);
    }

    public function test_category_delete()
    {
        $this->actingAs($this->user)->delete(route('admin.category.delete', $this->category->id));

        $this->assertSoftDeleted('categories', [
            'id' => $this->category->id
        ]);
    }
}