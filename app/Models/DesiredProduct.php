<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesiredProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault(['name' => 'Product not found']);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['name' => 'User not found']);
    }
}
