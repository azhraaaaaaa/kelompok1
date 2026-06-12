<?php

namespace App\Services;

use App\Contracts\SearchServiceContract;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService implements SearchServiceContract
{
    public function search(array $filters): LengthAwarePaginator
    {
        return new LengthAwarePaginator([], 0, 10);
    }

    public function autocomplete(string $query): Collection
    {
        return collect([
            [
                'label' => 'Bali',
                'place_id' => null,
                'source' => 'database',
            ]
        ]);
    }

    public function getPlaceDetails(string $placeId): array
    {
        return [];
    }

    public function searchAmadeusOffers(array $params): Collection
    {
        return collect();
    }
}