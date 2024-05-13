<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PrepareDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepare:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'database migration & seeding';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            if (app()->environment() == "local") {
                $this->info("preparing...");
                Artisan::call('migrate:fresh');
                $this->info("prepared db successfully.");
                
            } else {
                $this->error("Command run failed. App not in local environment");
            }
        } catch (Exception $e) {
            $this->error($e->getMessage() . " at " . $e->getLine() . " at " . $e->getFile());
        }
    }
}
