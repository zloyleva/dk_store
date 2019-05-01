<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait MultiFilters
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $filters
     */
    public function addMultiFilters(Builder $query, string $filters = null)
    {
        if (! $filters) {
            return;
        }

        $filters = explode(';', $filters);

        foreach ($filters as $filter) {
            $query->where(function ($query) use ($filter) {

                list($criteria, $value) = explode(':', $filter);
                foreach (explode(',', $value) as $item) {
                    $query->orWhere($criteria, $item);
                }

            });
        };
    }
}
