<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function variation_value() {
        return $this->belongsTo(VariationValue::class);
    }

    public function userorder() {
        return $this->belongsTo(UserOrder::class, 'order_id');
    }
}
