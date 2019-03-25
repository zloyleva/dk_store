<?php

namespace App\Jobs;

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
     */
    public function handle(Product $product)
    {
        $this->priceLine = preg_replace('/\t+/', '', $this->priceLine); //Remove tab characters, because these will broke parser
        $rawProduct = json_decode($this->priceLine, JSON_UNESCAPED_UNICODE);
        $product->insertOrUpdateProducts($rawProduct);
    }
}
