<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentType = PaymentType::whereTranslation('name', 'Nagt töleg', 'tk')
            ->whereTranslation('name', 'Cash payment', 'en')
            ->whereTranslation('name', 'Оплата наличными', 'ru')
            ->first();

        if (!$paymentType) {
            PaymentType::create([
                'tk' => ['name' => 'Nagt töleg'],
                'en' => ['name' => 'Cash payment'],
                'ru' => ['name' => 'Оплата наличными'],
                'status' => 1,
            ]);
        }

        $paymentType = PaymentType::whereTranslation('name', 'Töleg terminaly', 'tk')
            ->whereTranslation('name', 'Payment terminal', 'en')
            ->whereTranslation('name', 'Платежный терминал', 'ru')
            ->first();

        if (!$paymentType) {
            PaymentType::create([
                'tk' => ['name' => 'Töleg terminaly'],
                'en' => ['name' => 'Payment terminal'],
                'ru' => ['name' => 'Платежный терминал'],
                'status' => 1,
            ]);
        }

        $paymentType = PaymentType::whereTranslation('name', 'Onlaýn töleg', 'tk')
            ->whereTranslation('name', 'Online payment', 'en')
            ->whereTranslation('name', 'Онлайн платеж', 'ru')
            ->first();

        if (!$paymentType) {
            PaymentType::create([
                'tk' => ['name' => 'Onlaýn töleg'],
                'en' => ['name' => 'Online payment'],
                'ru' => ['name' => 'Онлайн платеж'],
                'status' => 1,
            ]);
        }

        $paymentType = PaymentType::whereTranslation('name', 'QR kod töleg', 'tk')
            ->whereTranslation('name', 'QR code payment', 'en')
            ->whereTranslation('name', 'Оплата по QR-коду', 'ru')
            ->first();

        if (!$paymentType) {
            PaymentType::create([
                'tk' => ['name' => 'QR kod töleg'],
                'en' => ['name' => 'QR code payment'],
                'ru' => ['name' => 'Оплата по QR-коду'],
                'status' => 1,
            ]);
        }
    }
}
