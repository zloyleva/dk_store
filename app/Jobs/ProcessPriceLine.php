<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ProcessPriceLine implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $priceLine;

    /**
     * ProcessPriceLine constructor.
     * @param string $priceLine
     */
    public function __construct(string $priceLine)
    {
        $this->priceLine = $priceLine;
    }

    /**
     * @param Product $product
     * @param Category $category
     * @throws \Exception
     */
    public function handle(Product $product, Category $category)
    {
        $this->priceLine = preg_replace(['/(\\\\([^"]))/', '/\t+/'], ['/${2}', ''], $this->priceLine); //Remove "tab" and "\" characters, because these will broke parser

        $rawProduct = json_decode($this->priceLine, JSON_UNESCAPED_UNICODE);
        try{
            $currentCategoryId = $category->insertNewCategory(collect($rawProduct['category']));
            $product->insertOrUpdateProducts($rawProduct, $currentCategoryId);
        }catch (\Exception $exception){
            Log::error(print_r($rawProduct,true));
            $this->fail("Duplicate insert!");
        }


    }
}
