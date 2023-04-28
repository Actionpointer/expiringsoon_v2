<?php

namespace App\Console;

use App\Jobs\ExpiredStatusUpdateJob;
use App\Jobs\ExpiringStatusUpdateJob;
use App\Jobs\InactiveStatusUpdateJob;
use App\Jobs\CheckOrderExpectedDateJob;
use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\ConvertDeliveredToCompletedJob;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new CheckOrderExpectedDateJob)->daily();
        $schedule->job(new ConvertDeliveredToCompletedJob)->daily();
        $schedule->job(new ExpiredStatusUpdateJob)->hourly();
        $schedule->job(new ExpiringStatusUpdateJob)->hourly();
        $schedule->job(new InactiveStatusUpdateJob)->hourly();

        // Your cronjob should run this: php /path/to/laravel/artisan queue:work --stop-when-empty
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
