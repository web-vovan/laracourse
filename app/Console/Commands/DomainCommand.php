<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создание нового домена';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain = $this->ask('Input new Domain name');

        $domainPath = base_path() . '/src/domain/' . $domain;

        // Создание папок для домена
        File::makeDirectory($domainPath);
        File::makeDirectory($domainPath . '/Actions');
        File::makeDirectory($domainPath . '/Collections');
        File::makeDirectory($domainPath . '/QueryBuilders');
        File::makeDirectory($domainPath . '/Providers');

        return Command::SUCCESS;
    }
}
