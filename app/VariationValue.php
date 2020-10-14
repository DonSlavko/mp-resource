<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariationValue extends Model
{
    protected $guarded = [];

    public function variation() {
        return $this->belongsTo(Variation::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'variation_value_product');
    }
}
