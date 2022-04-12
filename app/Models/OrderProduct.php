<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'price',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault([
            'name' => $this->name
        ]);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalAmountAttribute()
    {
        return number_format($this->price * $this->quantity, 2);
    }
}