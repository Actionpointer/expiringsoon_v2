<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminNotifications\DatabaseUpdateFailed;
use App\Notifications\AdminNotifications\DatabaseUpdateSuccess;

class UpdateCountriesStatesCitiesSQLite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-countries-states-cities-sqlite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // URLs from GitHub
        $repos = [
            'countries' => 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/sqlite/countries.sqlite3',
            'states' => 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/sqlite/states.sqlite3',
            'cities' => 'https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/sqlite/cities.sqlite3'
        ];

        $targetDir = base_path('database/sqlites/');
        //dd($targetDir);
        try {
            foreach ($repos as $name => $url) {
                $filePath = $targetDir . "$name.sqlite3";
                $this->downloadFile($url, $filePath);
                
                // Send success notification instead of echo
                $admin = config('mail.admin_email');
                Notification::route('mail', $admin)
                    ->notify(new DatabaseUpdateSuccess($name));
                
                $this->info("$name updated successfully.");
            }
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            
            // Send error notification to admin
            $admin = config('mail.admin_email');
            Notification::route('mail', $admin)
                ->notify(new DatabaseUpdateFailed($e->getMessage()));
        }
    }

    public function downloadFile($url, $path){
        file_put_contents($path, fopen($url, 'r'));
    }
}
