<?php

namespace App\Services;

use App\Contracts\SearchServiceContract;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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
        return [
            'name' => 'Pantai Kuta',
            'city' => 'Bali',
        ];
    }

    public function searchAmadeusOffers(array $params): Collection
    {
        return collect([
            [
                'hotel' => 'Hotel Example',
                'price' => 500000,
            ]
        ]);
    }
}