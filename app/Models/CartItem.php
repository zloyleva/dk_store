<?php

namespace App\Models;

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
     * @return mixed
     */
    public function addToCart(array $data){
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

    public function getCurrentUserCart(User $user){
        return $this->with("product")->where("user_id",$user->getUserId())->get();
    }
}
