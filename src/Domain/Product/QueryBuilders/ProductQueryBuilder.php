<?php

namespace Domain\Product\QueryBuilders;

use Domain\Catalog\Facades\Sorter;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class ProductQueryBuilder extends Builder
{
    public function homePage(): ProductQueryBuilder
    {
        return $this
            ->where('on_home_page', true)
            ->orderBy('sorting')
            ->limit(5);
    }

    public function filtered(): ProductQueryBuilder
    {

//        // Обычная реализация последовательного вызова фильтров
//        foreach (filters() as $filter)
//        {
//            $filter->apply($query);
//        }

        // Вызов фильтров через PipeLine
         return app(Pipeline::class)
            ->send($this)
            ->through(filters())
            ->thenReturn();
    }

    public function sorted(): ProductQueryBuilder
    {
        return Sorter::run($this);
    }

    public function withCategory(Category $category): ProductQueryBuilder
    {
        return $this->when($category->exists, function (Builder $query) use ($category) {
            $query->whereRelation(
                'categories',
                'categories.id',
                '=',
                $category->id
            );
        });
    }

}
