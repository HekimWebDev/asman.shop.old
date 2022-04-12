<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'comment',
        'status',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name ?? '';
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class)->withDefault([
            'name' => 'Nagt'
        ]);
    }

    public function orderOnlinePayment()
    {
        return $this->hasOne(OrderOnlinePayment::class)->withDefault();
    }

    public function getTotalAttribute()
    {
        return $this->orderProducts->sum(function ($product) {
            return $product->price * $product->quantity;
        });
    }

    public function getQuantityAttribute()
    {
        return $this->orderProducts->sum(function ($product) {
            return $product->quantity;
        });
    }
}