<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPaymentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'payment_type_id',
        'amount'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function payment_type() {
        return $this->belongsTo('App\Models\PaymentType');
    }
}
