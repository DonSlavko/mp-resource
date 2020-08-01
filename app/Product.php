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
        return $this->hasMany(Attribute::class);
    }

    public function attributeValues() {
        return $this->hasMany(AttributeValue::class);
    }
}
