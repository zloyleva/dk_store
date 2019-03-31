<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'product_id', 'count'];

    public function product(){
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
                "count" => \DB::raw('count + 1')
            ]
        );
    }

    public function getCurrentUserCart(){
        return $this->with("product")->get();
    }
}
