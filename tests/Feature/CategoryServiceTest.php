<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\CategoryService;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test add category, it should persist add category and return category object correctly
     */
    public function test_add(): void
    {
        $payload = [
            'id' => 'abc',
            'name' => 'test category',
            'created_at' => 123,
        ];

        $category = (new CategoryService())->add($payload);

        $this->assertEquals($category->id, $payload['id']);
        $this->assertEquals($category->name, $payload['name']);
        $this->assertEquals($category->created_at, $payload['created_at']);
    }
}
