<?php

namespace Sbhadra\Instafeeds\Providers;

use Juzaweb\Support\ServiceProvider;
use Sbhadra\Instafeeds\Actions\MainAction;
class InstafeedsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
        $this->registerAction([
            MainAction::class
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
