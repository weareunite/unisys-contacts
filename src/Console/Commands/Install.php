<?php

namespace Unite\Contacts\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unisys-api:contacts:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install contacts module to Unisys API';

    /*
     * Execute the console command.
     */
    public function handle(Filesystem $files)
    {
        $this->info('Installing ...');

        $this->install();

        $this->info('UniSys module was installed');
    }

    private function install()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Webpatser\\Countries\\CountriesServiceProvider'
        ]);

        $this->call('countries:migration');

        $this->call('migrate');

        $this->call('db:seed', ['--class' => 'CountriesSeeder']);

        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Contacts\\ContactsServiceProvider'
        ]);

        $this->call('migrate');
    }
}