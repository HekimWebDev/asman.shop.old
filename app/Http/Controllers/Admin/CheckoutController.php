<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\ArrayToXml\ArrayToXml;
use App\Traits\YandexDisk;

class CheckoutController extends Controller
{
    use YandexDisk;

    public function __invoke()
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
                'Дата' => $order->created_at->toDateString(),
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
                            'Значение' => 'false'
                        ],
                        [
                            'Наименование' => 'Проведен',
                            'Значение' => 'true'
                        ],
                        [
                            'Наименование' => 'Дата отгрузки',
                            'Значение' => $order->created_at->addDays(1)->toDateString()
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
