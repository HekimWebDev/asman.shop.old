<?php

namespace App\Console\Commands\TigerImports;

use App\Models\Category;
use App\Models\Category as CategoryLaravel;
use App\Services\LogoTiger\TigerService;

//use Codexshaper\WooCommerce\Facades\Category;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

//use mysql_xdevapi\Exception;

class SyncCategories extends Command
{
    protected array $commands = [
        'tiger:sync:categories'
    ];

    protected $signature = 'tiger:sync:categories';

    protected $description = 'Importing or updating categories from tiger service';

    /**
     * @throws GuzzleException
     * @throws \Spatie\Translatable\Exceptions\AttributeIsNotTranslatable
     */
    public function handle(): void
    {
        $this->info('Importing categories from tiger service ...');

        $limit = 10;
        $offset = 0;
        $stopOn = 600000;
        $name = 'Category';

        do {
            $items = (new TigerService())
                ->categoriesRequest()
                ->limit($limit)
                ->offset($offset)
                ->send()
                ->getResponse()
                ->toDto()
                ->asCollection();

//            Storage::disk('tiger')->put($name . '.json', $items);

            $items->each(function ($item) {

                $name = Str::title($item->name);

                $exists = Category::first()->getTranslations('name', 'en');
//                dd($exists);
                if ($exists === $name || empty($name)) {
                    return;
                }

                $data = [
                    'name' => $name
                ];
                try {
                    Category::create($data);
                } catch (\Exception $e) {
                    dd($data);
                }
            });

            $count = $items->count();
            $this->info("$limit - limit, $offset - offset, $count - categories imported");

            $offset = $limit + $offset;

            if ($offset > $stopOn) {
                break;
            }
        } while ($count > 0);

        $this->info("job done");
    }
}
