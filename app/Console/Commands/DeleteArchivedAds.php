<?php

namespace App\Console\Commands;

use App\Models\CarAd;
use App\Settings\AdSettings;
use Illuminate\Console\Command;

class DeleteArchivedAds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ad:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete archived ads';

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
    public function handle(AdSettings $adSettings)
    {
        $carAds = CarAd::whereNotNull('published_at')->get();
        $carAds->map(function ($carAd) use ($adSettings) {
            $published_at = $carAd->published_at;
            $day = now()->diffInDays($published_at);
            $day < $adSettings->archive_day_limit ?: $carAd->delete();
        });

        $this->info('Deleted archived ads successfully.');
    }
}
