<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'sku',
        'name',
        'slug',
        'description',
        'price_user',
        'price_3_opt',
        'price_8_opt',
        'price_dealer',
        'price_vip',
        'category_id',
        'stock',
        'featured',
        'image',
        'views',
        'sales_count',
        'rate',
    ];

    /**
     * @param array $item
     * @param int $categoryId
     */
    public function insertOrUpdateProducts(array $item, int $categoryId=0){

        Log::info("in model " . $item['sku']);
        $imageURL = '/images/no-image.png';

        $this->updateOrCreate(
            ['sku'         => (integer) $item['sku']],
            [
                'name'        => trim($item['name']),
                'slug'        => Str::slug($item['name'],'-'),
                'description' => $item['description'],

                'price_user'   => (float) strtr( $item['price_user'], [ ',' => '.' ] ),
                'price_3_opt'  => (float) strtr( $item['price_3_opt'], [ ',' => '.' ] ),
                'price_8_opt'  => (float) strtr( $item['price_8_opt'], [ ',' => '.' ] ),
                'price_dealer' => (float) strtr( $item['price_dealer'], [ ',' => '.' ] ),
                'price_vip'    => (float) strtr( $item['price_vip'], [ ',' => '.' ] ),

                'category_id' => $categoryId,
                'stock'       => (int)  preg_replace('/\s+/', '', $item['stock']),
                'featured'    => false,
                'image'       => $imageURL
            ]
        );
    }
}
