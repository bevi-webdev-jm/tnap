<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type'
    ];

    public function order_payment_type() {
        return $this->hasMany('App\Models\OrderPaymentType');
    }
}
