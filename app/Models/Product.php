<?php

namespace App\Models;

use App\Models\Traits\Pagination;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Product extends Model
{
    use Pagination;

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
     * Set Relations
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories():BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

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

    /**
     * @param Request $request
     * @return Collection
     */
    public function getAll(Request $request):Collection
    {
        $query = $this->with('categories');
        return collect( $this->addPagination($query, $request->query()) );
    }
}
