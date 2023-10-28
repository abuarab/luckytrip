<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class NameFilter implements FilterInterface {

    public function apply(Builder $query, array $filters): Builder {
        if (isset($filters['name'])) {
            return $query->whereHas('translations', function (Builder $query) use ($filters) {
                $query->where('name', 'like', "%{$filters['name']}%");
            });
        }

        return $query;
    }
}
