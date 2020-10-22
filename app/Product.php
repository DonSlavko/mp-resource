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

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function product_images() {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }

    public function variation() {
        return $this->belongsToMany(Variation::class, 'product_variation');
    }

    public function attributeValues() {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value_product');
    }

    public function variationValues() {
        return $this->belongsToMany(VariationValue::class, 'variation_value_product')->withPivot('quantity', 'price');
    }

    public function scopeFilterAttributesValues($query, $ids) {
        if ($ids) {
            $query->whereHas('attributeValues', function($query) use ($ids) {
                $query->whereIn('attribute_value_product.attribute_value_id', $ids);
            });
        }
    }
}
