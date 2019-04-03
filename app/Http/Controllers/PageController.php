<?php

namespace App\Http\Controllers;

use App\Jobs\ParsePrice;
use App\Models\Product;
use App\Services\ReadPrice\ReadPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PageController extends Controller
{
    public function readPrice(ReadPrice $readPrice, Product $product){
        echo "readPrice";
        ParsePrice::dispatch($readPrice, $product);
    }

}
