<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function add($payload): Category
    {
        $category = new Category;
        $category->id = $payload['id'];
        $category->name = $payload['name'];
        $category->created_at = $payload['created_at'];
        $category->save();

        return $category;
    }
}
