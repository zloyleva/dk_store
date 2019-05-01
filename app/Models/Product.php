<?php

namespace App\Models;

use App\Models\Traits\Pagination;
use App\Models\Traits\Search;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Product extends Model
{
    use Pagination, Search;

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

    protected $searchable = [
        'name', 'sku'
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
     * @return \App\Models\Product
     */
    public function insertOrUpdateProducts(array $item, int $categoryId=0):Product
    {

        Log::info("in model " . $item['sku']);
        $imageURL = '/images/no-image.png';

        return $this->updateOrCreate(
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
        $price_name = "price_user";
        $price_desc = "Розничная";

        if(auth()->check()){
            $users_price = auth()->user()->price_type()->first();
            $price_name = $users_price->type;
            $price_desc = $users_price->description;
        }

        $query = $this->select(['id','sku','name','description',

            "$price_name as price",
            DB::raw("'$price_desc' as price_desc"),

            'category_id','stock','image','views','rate',]);

        $query->with('categories');

        if(isset($request->search)){
            $this->addSearch($query, $request->search, $this->searchable);
        }

        return collect( $this->addPagination($query, $request->query()) );
    }
}
