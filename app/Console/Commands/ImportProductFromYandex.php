<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Traits\YandexDisk;
use Arhitector\Yandex\Disk;
use Illuminate\Console\Command;

class ImportProductFromYandex extends Command
{
    use YandexDisk;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '1C:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncing products in 1C';

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
        $disk = new Disk($this->token);

        $resource = $disk->getResource($this->import_path . '/' . $this->import_file);

        $resource->download($this->download($this->import_file));

        $xml = simplexml_load_file($this->openFile($this->import_file));

        $products = $xml->Каталог->Товары->Товар;

        $productIds = $this->products($products);
        $productModelIds = Product::all()->pluck('one_c_id');
        $diffIds = $productModelIds->diff($productIds);
        $diffIds->each(
            fn($id) => Product::where('one_c_id', $id)->delete()
        );

        $this->deleteFile($this->import_file);

        $this->info('Products synced successfully.');

        $this->productDetail();
    }

    public function products($products)
    {
        $productIds = collect();

        foreach ($products as $product) {
            $categoryModel = Category::where('one_c_id', $product->Группы->Ид)->first();
            if (!$categoryModel) continue;
            $productModel = Product::firstOrCreate(
                ['one_c_id' => $product->Ид],
                [
                    'one_c_category_id' => $product->Группы->Ид,
                    'status' => 0,
                    'vendor_code' => $product->Артикул,
                    'ru' => [
                        'name' => $product->Наименование
                    ],
                    'tk' => [
                        'name' => $product->Наименование,
                    ],
                    'en' => [
                        'name' => $product->Наименование,
                    ]
                ]
            );

            $productModel->one_c_category_id = $product->Группы->Ид->__toString();
            $productModel->translate('ru')->name = $product->Наименование->__toString();
            $productModel->save();

            $productIds->push($productModel->one_c_id);
        }

        return $productIds;
    }

    public function productDetail()
    {
        $disk = new Disk($this->token);

        $resource = $disk->getResource($this->import_path . '/' . $this->offers_file);

        $resource->download($this->download($this->offers_file));

        $xml = simplexml_load_file($this->openFile($this->offers_file));

        $prices = $xml->ПакетПредложений->Предложения->Предложение;

        foreach ($prices as $price) {
            $productId = $price->Ид;
            $productModel = Product::whereOneCId($productId)->first();
            if ($productModel) {
                $productModel->quantity = $price->Количество->__toString();
                if ($productModel->price != $price->Цены->Цена->ЦенаЗаЕдиницу) {
                    $productModel->price = $price->Цены->Цена->ЦенаЗаЕдиницу;
                }
                $productModel->save();
            }
        }

        $this->deleteFile($this->offers_file);

        return $this->info('Products detail synced successfully.');
    }
}
