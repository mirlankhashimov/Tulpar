<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     *
     */

    public function test_can_get_categories()
    {
        $response = $this->get('api/categories');
        $response->assertStatus(200);
    }

    public function test_can_create_category()
    {
        $data = ['name' => 'EU'];
        $response = $this->json('POST', 'api/categories', $data);
        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function test_can_update_category()
    {
        $category = factory(Category::class)->create();
        $data = [
            'name' => $this->faker->name,
        ];
        $this->put(route('categories.update', $category->id), $data)
            ->assertStatus(200)
            ->assertJson(['updated' => true]);
    }

    public function test_can_get_by_id_category()
    {
        $category = factory(Category::class)->create();
        $this->get(route('categories.show', $category->id))
            ->assertStatus(200);
    }

    public function test_can_delete_category()
    {
        $category = factory(Category::class)->create();
        $this->delete(route('categories.destroy', $category->id))
            ->assertStatus(200)
            ->assertJson(['deleted' => true]);
    }
}
