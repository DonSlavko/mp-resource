<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = "payment_statuses";

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function order() {
        return $this->belongsTo(UserOrder::class, 'order_id');
    }
}
