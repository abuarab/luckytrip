<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class LocationFilter implements FilterInterface
{
    public function apply(Builder $query, array $filters): Builder {
        if (isset($filters['latitude']) && isset($filters['longitude'])) {
            $latitude = $filters['latitude'];
            $longitude = $filters['longitude'];

            return $query->orderByRaw("SQRT(POW(latitude - $latitude, 2) + POW(longitude - $longitude, 2))");
        }

        return $query;
    }
}
