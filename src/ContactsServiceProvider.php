<?php

namespace Unite\Contacts;

use Illuminate\Support\ServiceProvider;
use Route;
use Unite\Contacts\Console\Commands\Install;

class ContactsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        Route::patterns([
            'id'    => '^\d+$',
            'model' => '^\d+$',
        ]);
        $this->commands([
            Install::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        if (! class_exists('CreateContactsTables')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/create_contacts_tables.php.stub' => database_path("migrations/{$timestamp}_create_contacts_tables.php"),
            ], 'migrations');
        }
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register(\Webpatser\Countries\CountriesServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Countries', 'Webpatser\Countries\CountriesFacade');
    }
}
