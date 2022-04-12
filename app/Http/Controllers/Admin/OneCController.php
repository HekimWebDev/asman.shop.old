<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Traits\YandexDisk;
use Arhitector\Yandex\Disk;

class OneCController extends Controller
{
    use YandexDisk;

    public array $sections;

    public function __invoke()
    {
        $disk = new Disk($this->token);

        $resource = $disk->getResource($this->import_path . '/' . $this->import_file);

        $resource->download($this->download($this->import_file));

        $xml = simplexml_load_file($this->openFile($this->import_file));

        $categories = $xml->Классификатор->Группы->Группа->Группы->Группа;
        $products = $xml->Каталог->Товары->Товар;

        $this->deleteFile($this->import_file);

        $categoryIds = $this->categories($categories, null);
        $categoryModelIds = Category::all()->pluck('one_c_id');
        $diffIds = $categoryModelIds->diff($categoryIds);
        $diffIds->each(
            fn($id) => Category::where('one_c_id', $id)->delete()
        );

        $productIds = $this->products($products);
        $productModelIds = Product::all()->pluck('one_c_id');
        $diffIds = $productModelIds->diff($productIds);
        $diffIds->each(
            fn($id) => Product::where('one_c_id', $id)->delete()
        );

        $this->productDetail();
    }

    public function categories($categories, $parent_id = null)
    {
        foreach ($categories as $category) {
            $categoryModel = Category::firstOrCreate(
                ['one_c_id' => $category->Ид],
                [
                    'one_c_parent_id' => $parent_id,
                    'status' => 0,
                    'ru' => ['name' => $category->Наименование],
                    'tk' => ['name' => $category->Наименование],
                    'en' => ['name' => $category->Наименование]
                ]
            );

            $categoryModel->one_c_parent_id = $parent_id;
            $categoryModel->translate('ru')->name = $category->Наименование->__toString();
            $categoryModel->save();

            $this->sections[] = $category->Ид->__toString();

            if (isset($category->Группы)) {
                $this->categories($category->Группы->Группа, $category->Ид->__toString());
            }
        }

        return $this->sections;
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
    }
}
