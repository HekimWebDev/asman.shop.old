<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Spatie\ArrayToXml\ArrayToXml;
use App\Traits\YandexDisk;

class UploadOrderToYandex extends Command
{
    use YandexDisk;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '1C:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncing orders for 1C';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::active()
            ->whereIsApproved(true)
            ->whereDate('updated_at', now()->today())
            ->with(['orderProducts.product.translations', 'user'])
            ->get();

        if ($orders->isNotEmpty()) {
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
                    'Комментарий' => $order->paymentType->translate('ru')->name . '. ' . $order->comment,
                    'Контрагент' => [
                        'Ид' => $order->user->uuid,
                        'Наименование' => $order->user->first_name,
                        'Роль' => 'Покупатель',
                        'ПолноеНаименование' => $order->user->full_name
                    ],
                    'Товары' => [
                        'Товар' => $order->orderProducts->map(fn ($orderProduct) => [
                            'Ид' => $orderProduct->product->one_c_id,
                            'Артикул' => $orderProduct->product->vendor_code,
                            'Наименование' => $orderProduct->product->translate('ru')->name,
                            'ЦенаЗаЕдиницу' => $orderProduct->price,
                            'Количество' => $orderProduct->quantity,
                            'Сумма' => $orderProduct->total_amount,
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

            $this->info('Orders synced successfully.');
        } else {
            $this->info('No orders today.');
        }
    }
}
