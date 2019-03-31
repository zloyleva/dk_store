<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Search
{

    /**
     * @param Builder $query
     * @param string|null $search
     * @param array|null $fields
     */
    public function addSearch(Builder $query, string $search = null, array $fields=null)
    {
        if (!$search || !$fields) {
            return;
        }

        $query->where(function ($query) use ($fields,$search) {
            foreach ($fields as $field) {
                $query->orWhere(str_replace('`', '', $field), 'like', "%{$search}%");
            }
        });
    }
}
