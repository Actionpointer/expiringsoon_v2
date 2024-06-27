<?php

namespace App\Console;

use App\Jobs\PayoutRetryFailedJob;
use App\Jobs\PayoutStatusCheckJob;
use App\Jobs\AdsetExpiredNotifyJob;
use App\Jobs\SubscriptionExpiredJob;
use App\Jobs\AdvertInactiveNotifyJob;
use App\Jobs\PaymentPendingDeleteJob;
use App\Jobs\OrderRejectedToReversedJob;
use App\Jobs\OrderReversedToCompletedJob;
use App\Jobs\OrderDeliveredToCompletedJob;
use App\Jobs\OrderReturnedToAcceptanceJob;
use App\Jobs\SubscriptionResourceResetJob;
use App\Jobs\OrderProcessingToCancelledJob;
use App\Jobs\PayoutApprovedToProcessingJob;
use App\Jobs\SubscriptionExpiringNotifyJob;
use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\OrderProductExpiredToCancelledJob;
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
        $schedule->job(new AdsetExpiredNotifyJob)->hourly();
        $schedule->job(new AdvertInactiveNotifyJob)->hourly();
        $schedule->job(new OrderDeliveredToCompletedJob)->hourly();
        $schedule->job(new OrderProcessingToCancelledJob)->hourly();
        $schedule->job(new OrderProductExpiredToCancelledJob)->hourly();
        $schedule->job(new OrderRejectedToReversedJob)->hourly();
        $schedule->job(new OrderReversedToCompletedJob)->hourly();
        $schedule->job(new OrderReturnedToAcceptanceJob)->hourly();
        $schedule->job(new PaymentPendingDeleteJob)->hourly();
        $schedule->job(new PayoutApprovedToProcessingJob)->hourly();
        $schedule->job(new PayoutRetryFailedJob)->hourly();
        $schedule->job(new PayoutStatusCheckJob)->hourly();
        $schedule->job(new SubscriptionExpiredJob)->hourly();
        $schedule->job(new SubscriptionExpiringNotifyJob)->hourly();
        $schedule->job(new SubscriptionResourceResetJob)->hourly();



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
