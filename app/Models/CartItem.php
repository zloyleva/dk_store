<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'product_id', 'count'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,"product_id", "id");
    }

    /**
     * @param array $data
     * @return \App\Models\CartItem
     */
    public function addToCart(array $data):CartItem
    {
        return $this->updateOrCreate(
            [
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"],
            ],
            [
                "count" => \DB::raw('count + 1') //isset() || +1
            ]
        );
    }

    /**
     * @param array $data
     * @return \App\Models\CartItem
     */
    public function setItemCountInCart(array $data):CartItem
    {

        $count = $data['count'] >= 0 ? $data['count'] : 0;

        return $this->updateOrCreate(
            [
                "user_id" => $data["user_id"],
                "product_id" => $data["product_id"],
            ],
            [
                "count" => $count
            ]
        );
    }

    /**
     * @param \App\Models\User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentUserCart(User $user):Collection
    {
        $price_type = "price_user";

        if(auth()->check()){
            $current_price_type = auth()->user()->price_type()->first();
            $price_type = $current_price_type->type;
        }

        return $this->with(["product" => function($query)use($price_type){
            $query->select('id', 'name', "$price_type as price");
        }])->where("user_id",$user->getUserId())->get();
    }
}
