<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['parent_id', 'depth', 'name', 'slug'];

    /**
     * @param Collection $categories
     * @return int
     * @throws \Exception
     */
    public function insertNewCategory(Collection $categories):int
    {

        if(!count($categories)){
            throw new \Exception('Bad data given');
        }

        $categories = $this->clearCategoriesData($categories);
        $depth = count($categories);
        $slug = $this->getCategorySlug($categories);
        $name = $this->filterCategoriesNames($categories[$depth-1]);

        $currentCategory = $this->firstOrCreate(
            [
                'depth' => $depth,
                'parent_id' => $this->getParentCategoriesId($categories),
                'name' => $name,
            ],
            ['slug'         => $slug,]
        );
        return $currentCategory->id;
    }

    /**
     * @param Collection $categories
     * @return int
     * @throws \Exception
     */
    private function getParentCategoriesId(Collection $categories):int
    {
        if(count($categories) <= 1){
            return 0;
        }
        $categories->pop();
        return $this->insertNewCategory($categories);
    }

    /**
     * @param Collection $categories
     * @return Collection
     */
    private function clearCategoriesData(Collection $categories):Collection
    {
        return $categories->map(function ($item) {
            return trim($item);
        });
    }

    /**
     * @param Collection $categories
     * @return string
     */
    private function getCategorySlug(Collection $categories):string
    {
        return $categories->map(function ($item){
            return Str::slug($item,'-');
        })->join("--");
    }

    /**
     * @param string $categoryItem
     * @return string
     */
    private function filterCategoriesNames(string $categoryItem):string
    {
        $pattern = "/((\d+\.*)+\s)?(\D.+)/";
        return preg_replace($pattern, '$3', $categoryItem);
    }
}
