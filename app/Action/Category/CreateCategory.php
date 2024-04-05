<?php

namespace App\Action\Category;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CreateCategory
{
    function execute(CategoryRequest $request): Category
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return $category;
    }
}