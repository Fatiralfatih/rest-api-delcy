<?php

namespace App\Action\Category;

use App\Models\Category;

class GetCategoryByName
{

    function execute($nameCategory)
    {
        $category = Category::where('name', $nameCategory)->with(['product'])->firstOrFail();

        return $category;
    }
}