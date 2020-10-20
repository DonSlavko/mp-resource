<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserOrder extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class, 'order_id');
    }
}
