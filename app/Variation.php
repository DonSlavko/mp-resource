<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $guarded = [];

    /*public function products() {
        return $this->hasMany(Product::class);
    }*/

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function variationValues() {
        return $this->hasMany(VariationValue::class);
    }
}
