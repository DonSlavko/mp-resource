<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserPreorder extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->hasOne(UserOrder::class, 'preorder_id');
    }

    public function carts() {
        return $this->hasMany(Cart::class, 'preorder_id');
    }
}
