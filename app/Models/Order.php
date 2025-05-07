<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'customer_name',
        'address',
        'order_date',
        'total',
        'status',
        'payment_type',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function details() {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function logs() {
        return $this->hasMany('App\Models\OrderLog');
    }
}
