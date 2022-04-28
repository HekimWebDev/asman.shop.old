<?php

namespace App\Console\Commands\TigerImports;

use Illuminate\Console\Command;
use App\Services\LogoTiger\TigerService;
use Codexshaper\WooCommerce\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SyncBrands extends Command
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'tiger:sync:brands'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tiger:sync:brands';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing or updating brands from tiger service';

    public function handle(): mixed
    {
        $this->info('Importing categories from tiger service ...');

        $items = (new TigerService())
            ->brandsRequest()
            ->send()
            ->getResponse()
            ->toDto()
            ->asCollection();

        Storage::disk('tiger')->put('Brands' . '.json', $items);
        dd($items);
        $categories = Category::get();

        $items
            ->each(function ($item) use ($categories) {

                $name = Str::title($item->name);

                $exists = $categories->first(function ($item) use ($name) {
                    return $item->name == $name;
                });

                if ($exists) {
                    return;
                }

                $data = [
                    'name' => $name
                ];

                Category::create($data);
            });

        $count = $items->count();

        $this->info("$count - brands imported");
    }
}
