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

    private $price_name;
    private $price_desc;
    private $select_array;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->price_name = "price_user";
        $this->price_desc = "Розничная";

        if(auth()->check()){
            $users_price = auth()->user()->price_type()->first();
            $this->price_name = $users_price->type;
            $this->price_desc = $users_price->description;
        }

        $this->select_array = [
            'id','sku','slug','name','description', 'category_id','stock','image','views','rate',
            "$this->price_name as price",
            DB::raw("'$this->price_desc' as price_desc"),
        ];
    }

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
     * @return BelongsTo
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
        $imageURL = '/images/no-image.png'; // Todo change real imag

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
     * @param Collection|null $categoriesId
     * @return Collection
     */
    public function getAll(Request $request, Collection $categoriesId=null):Collection
    {
        $query = $this->selectProductWithCategory();

        if($categoriesId){
            $query->whereIn('category_id',$categoriesId);
        }

        if(isset($request->search)){
            $this->addSearch($query, $request->search, $this->searchable);
        }
        return collect( $this->addPagination($query, $request->query()) );
    }

    /**
     * @param $query
     * @param int $id
     * @param string $slug
     */
    public function scopeFindProduct($query,int $id, string $slug){
        $query->selectProductWithCategory()
            ->where(['id' => $id, 'slug' => $slug]);
    }

    /**
     * @param $query
     */
    public function scopeSelectProductWithCategory($query){
        $query->select($this->select_array)->with(['categories' => function($q){
            $q->with('parent');
        }]);
    }
}
