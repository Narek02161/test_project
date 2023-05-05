<?php

namespace App\Traits;

trait GetSortTrait
{
    public function transformSortKey(?array $sort): array
    {
        if (!$sort) {
            return [];
        }

        $result = [];
        foreach ($sort['key'] as $key => $field) {
            $result[] = [
                'key' => $sort['value'][$key] ?? 'asc',
                'value' => $field,
            ];
        }

        return $result;
    }
}
