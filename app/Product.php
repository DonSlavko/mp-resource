<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    protected $dates = [
        'updated_at',
        'created_at'
    ];

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
