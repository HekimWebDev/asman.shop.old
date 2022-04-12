<?php

namespace App\Jobs;

use App\Models\Order;
use App\Traits\YandexDisk;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\ArrayToXml\ArrayToXml;

class OrderUploadToYandexJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, YandexDisk;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::whereDate('created_at', now()->today())
            ->with(['products.product', 'user'])
            ->get();

        $root = [
            'rootElementName' => 'КоммерческаяИнформация',
            '_attributes' => [
                'ВерсияСхемы' => 2.04,
                'ДатаФормирования' => date('Y-m-d\TH:i:s'),
            ]
        ];

        $array = [
            'Документ' => $orders->map(fn ($order) => [
                'Ид' => $order->uuid,
                'Номер' => $order->id,
                'Дата' => date('d.m.Y H:i:s'),
                'ХозОперация' => 'Заказ товара',
                'Роль' => 'Продавец',
                'Валюта' => 'TMT',
                'Курс' => '1.0000',
                'Сумма' => $order->total,
                'Время' => $order->created_at->toTimeString(),
                'СрокПлатежа' => $order->created_at->addDays(7)->toDateString(),
                'Комментарий' => '',
                'Контрагент' => [
                    'Ид' => $order->user->uuid,
                    'Наименование' => $order->user->first_name,
                    'Роль' => 'Покупатель',
                    'ПолноеНаименование' => $order->user->full_name
                ],
                'Товары' => [
                    'Товар' => $order->products->map(fn ($product) => [
                        'Ид' => $product->product->one_c_id,
                        'Артикул' => $product->product->vendor_code,
                        'Наименование' => $product->product->translate('ru')->name,
                        'ЦенаЗаЕдиницу' => $product->price,
                        'Количество' => $product->quantity,
                        'Сумма' => $product->total_amount,
                        'Единица' => 'пар',
                        'Коэффициент' => 1
                    ])->toArray()
                ],
                'ЗначенияРеквизитов' => [
                    'ЗначениеРеквизита' => [
                        [
                            'Наименование' => 'ПометкаУдаления',
                            'Значение' => 'false',
                        ],
                        [
                            'Наименование' => 'Проведен',
                            'Значение' => 'true'
                        ]
                    ]
                ]
            ])->toArray()
        ];

        $result = new ArrayToXml($array, $root, true, 'UTF-8');
        $result = $result->prettify()->toXml();

        $this->upload($result);
    }
}
