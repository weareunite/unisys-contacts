<?php

namespace Unite\Contacts\Console\Commands;

use Unite\UnisysApi\Console\InstallModuleCommand;

class Install extends InstallModuleCommand
{
    protected $moduleName = 'contacts';

    protected $filesystem;

    protected function install()
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