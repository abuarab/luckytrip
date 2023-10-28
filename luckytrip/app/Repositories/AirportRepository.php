<?php

namespace App\Repositories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\NameFilter;
use App\Filters\LocationFilter;
use App\Filters\OrderFilter;

class AirportRepository {
    public function getAllFiltered(array $filters): Builder {
        $query = Airport::query();

        $filterChain = $this->getFilterChain();
        foreach ($filterChain as $filter) {
            $query = $filter->apply($query, $filters);
        }

        return $query;
    }

    private function getFilterChain(): array {
        return [
            new NameFilter(),
            new LocationFilter(),
            new OrderFilter(),
        ];
    }
}
