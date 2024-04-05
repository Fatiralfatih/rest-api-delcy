<?php

namespace App\Action\Category;

use App\Models\Category;

class GetCategories
{
    function execute()
    {
        $categories = Category::all();

        return $categories;
    }
}