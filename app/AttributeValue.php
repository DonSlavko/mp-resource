<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $guarded = [];

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }
}
