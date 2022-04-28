<?php

namespace App\Console\Commands\TigerImports;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use App\Services\LogoTiger\TigerService;
use Codexshaper\WooCommerce\Facades\Category;
use Codexshaper\WooCommerce\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\WooProductMetaLookup as WooProduct;

class ImportItems extends Command
{
    protected array $commands = [
        'tiger:import:items'
    ];

    protected $signature = 'tiger:import:items';

    protected $description = 'Importing items from tiger service';

    public function handle()
    {
        $this->info('Importing items from tiger service ...');

        $limit = 20;
        $offset = 0;
        $stopOn = 1000000;
        $name = 'Items';

        do {
            $items = (new TigerService())
                ->itemsRequest()
                ->include([
                    'units',
                    'brand',
                    'stocks',
                    'barcodes',
                ])
                ->limit($limit)
                ->offset($offset)
                ->send()
                ->getResponse()
                // ->saveData();
                ->toDto()
                ->asCollection();
            // get all categories from woo;

//            Storage::disk('tiger')->put($name . '.json', $items);
            dd($items);
            $categories = Category::all(['per_page' => 100]);

            $products = $items
                ->map(function ($item) use ($categories) {
                    $item = $item->buildAttributeData();

                    $category = $categories->first(function ($cat) use ($item) {
                        return $cat->name === Str::title($item->category);
                    });

                    return [
                        'name' => $item->name,
                        'type' => 'simple',
                        'regular_price' => '21.99',
                        'status' => 'draft',
                        'manage_stock' => true,
                        'stock_quantity' => $item->stocks[0]?->onhand,
                        'stock_status' => 'instock',
                        'backorders' => "no",
                        'backorders_allowed' => false,
                        'backordered' => false,
                        'sold_individually' => false,

                        'sku' => "{$item->item_id}-{$item->code}",

                        'description' => $item->description,
                        'short_description' => $item->description,
                        'categories' => [
                            [
                                'id' => $category->id
                            ],
                        ],
                        'images' => [
                            [
                                'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg'
                            ],
                            [
                                'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg'
                            ]
                        ]
                    ];
                });

            $data = collect([
                'update' => collect(),
                'create' => collect()
            ]);

            $products
                ->each(function ($p) use ($data) {
                    $earlyCreated = WooProduct::whereSku($p['sku'])->exists();
                    $key = $earlyCreated ? 'update' : 'create';
                    $data[$key]->push($p);
                });

            Product::batch($data);

            $count = $items->count();
            $this->info("$limit - limit, $offset - offset, $count - items imported");

            $offset = $limit + $offset;

            if ($offset > $stopOn) {
                break;
            }
        } while ($count > 0);

        $this->info("job done");
    }
}
