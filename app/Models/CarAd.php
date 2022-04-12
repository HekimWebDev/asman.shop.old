<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CarAd extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    protected $fillable = [
        'user_id',
        'car_model_id',
        'year',
        'car_body_id',
        'mileage',
        'motor',
        'car_transmission_id',
        'car_type_of_drive_id',
        'car_colour_id',
        // 'vin_code',
        'price',
        'car_place_id',
        'can_credit',
        'can_exchange',
        'additional',
        'can_comment',
        'slug',
        'status',
        'published_at'
    ];

    protected $casts = [
        'can_comment' => 'boolean',
        'can_credit' => 'boolean',
        'can_exchange' => 'boolean',
        'price' => 'double'
    ];

    protected $dates = [
        'published_at'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => [
                    'carModel.translation.name',
                    'year',
                    'carBody.translation.name',
                    'mileage',
                    'motor',
                    'carColour.translation.name'
                ]
            ]
        ];
    }

    public function scopeIsPublished($query)
    {
        return $query->where('status', 'published');
    }

    public function getDescriptionAttribute()
    {
        return $this->additional;
    }

    public function getIsPremiumAttribute(): bool
    {
        $lastCarAdType = $this->carAdType()->latest()->first();
        return
            isset($lastCarAdType)
            && $lastCarAdType->is_active
            && now()->diffInSeconds($lastCarAdType->expire_date, false) > 0;
    }

    public function carAdType(): HasOne
    {
        return $this->hasOne(CarAdType::class);
    }

    public function carAdTypes(): HasMany
    {
        return $this->hasMany(CarAdType::class);
    }

    public function carAdPhones()
    {
        return $this->hasMany(CarAdPhone::class);
    }

    public function carBody()
    {
        return $this->belongsTo(CarBody::class)->withDefault('null');
    }

    public function carColour()
    {
        return $this->belongsTo(CarColour::class)->withDefault('null');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class)->withDefault('null');
    }

    public function carPlace()
    {
        return $this->belongsTo(CarPlace::class)->withDefault('null');
    }

    public function carTypeOfDrive()
    {
        return $this->belongsTo(CarTypeOfDrive::class)->withDefault('null');
    }

    public function carTransmission()
    {
        return $this->belongsTo(CarTransmission::class)->withDefault('null');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault('null');
    }
}
