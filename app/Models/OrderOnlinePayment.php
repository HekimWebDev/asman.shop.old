<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'bank_order_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
