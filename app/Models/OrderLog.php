<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'remarks',
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
