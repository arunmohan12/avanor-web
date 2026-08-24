<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PropertySearchService
{
    public function search(array $filters): LengthAwarePaginator
    {
        $query = Property::query()
            ->with([
                'developer',
                'community',
                'project',
                'propertyType',
            ]);

        if (filled($filters['property_type'] ?? null)) {
            $query->where(
                'property_type_id',
                (int) $filters['property_type']
            );
        }

        if (filled($filters['community'] ?? null)) {
            $query->where(
                'community_id',
                (int) $filters['community']
            );
        }

        if (filled($filters['bedrooms'] ?? null)) {
            $bedrooms = (string) $filters['bedrooms'];

            if (str_ends_with($bedrooms, '+')) {
                $query->where(
                    'bedrooms',
                    '>=',
                    (int) rtrim($bedrooms, '+')
                );
            } else {
                $query->where('bedrooms', (int) $bedrooms);
            }
        }

        if (filled($filters['price'] ?? null)) {
            $this->applyPriceFilter(
                $query,
                (string) $filters['price']
            );
        }

        return $query
            ->latest('id')
            ->paginate(9);
    }

    private function applyPriceFilter(
        Builder $query,
        string $range
    ): void {
        if (str_ends_with($range, '+')) {
            $query->where(
                'price',
                '>=',
                (int) rtrim($range, '+')
            );

            return;
        }

        $values = explode('-', $range, 2);

        if (count($values) !== 2) {
            return;
        }

        [$minimum, $maximum] = array_map('intval', $values);

        $query->whereBetween('price', [
            $minimum,
            $maximum,
        ]);
    }
}
