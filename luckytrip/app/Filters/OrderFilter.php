<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter implements FilterInterface
{
    public function apply(Builder $query, array $filters): Builder {
        $order = $filters['order'] ?? 'asc';

        if ($order === 'desc') {
            return $query->orderByDesc('id');
        } else {
            return $query->orderBy('id');
        }
    }
}
