<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh data';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::SUCCESS;
        }

        Storage::deleteDirectory('images');

        $this->call('cache:clear');

        $this->call('migrate:fresh', [
            '--seed' => true
        ]);


        return self::SUCCESS;
    }
}
