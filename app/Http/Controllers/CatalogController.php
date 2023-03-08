<?php

namespace App\Http\Controllers;

use App\ViewModels\CatalogViewModel;
use Domain\Catalog\Models\Category;

class CatalogController extends Controller
{
    public function __invoke(?Category $category)
    {
        return response()->view(
            'catalog.index',
            new CatalogViewModel($category)
        );
    }
}
