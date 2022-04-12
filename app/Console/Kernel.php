<?php

namespace App\Console;

use App\Jobs\OrderUploadToYandexJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DeleteArchivedAds::class,
        Commands\ImportCategoryFromYandex::class,
        Commands\ImportProductFromYandex::class,
        Commands\UploadOrderToYandex::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('1c:category')->everyThreeMinutes()->runInBackground();
        $schedule->command('1c:product')->everyFiveMinutes()->runInBackground();
        $schedule->command('1c:order')->everyMinute()->runInBackground();
        $schedule->command('ad:archive')->daily()->runInBackground();
        $schedule->command('backup:run')->dailyAt('23:55');
        $schedule->command('backup:clean')->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
