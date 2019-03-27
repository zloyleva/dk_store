<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;

trait Pagination
{

    /**
     * @param Builder $query
     * @param array $params
     * @param null $per_page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Builder
     */
    public function addPagination(Builder $query, array $params, $per_page = null)
    {

        if($per_page === 'all'){
            $per_page = $query->count();
        }

        $query = $query->paginate($per_page ?? config('app_custom.page.perPage'));

        foreach ($params as $paramKey => $paramValue) {
            $query->appends($paramKey, $paramValue);
        }
        return $query;
    }
}
