<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearConfigAndRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:config-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the config and routes cache';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        \Artisan::call('route:clear');
        \Artisan::call('route:cache');
        \Artisan::call('view:clear');
        \Artisan::call('route:cache');
        \Artisan::call('cache:clear');
        $this->info('Config and routes cache cleared successfully.');
    }
}
