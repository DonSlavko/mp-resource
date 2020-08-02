<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function variation() {
        return $this->belongsTo(Variation::class);
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function attributeValues() {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value_product');
    }
}
