<?php

namespace App\QueryBuilder\Sorts;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class TranslationSort implements Sort
{
    public function __invoke(Builder $query, $descending, string $property): Builder
    {
        return $query->OrderByTranslation($property, $descending ? 'desc' : 'asc');
    }
}
