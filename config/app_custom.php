<?php
 return [
    "price" => [
        "price_path" => env('PRICE_FILE_PATH', 'price/price.json')
    ],
     "page" => [
         "perPage" => env('PER_PAGE', 20)
     ]
 ];
