<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function preorder() {
        return $this->hasOne(Preorder::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
