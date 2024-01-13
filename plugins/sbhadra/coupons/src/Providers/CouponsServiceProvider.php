<?php

namespace Sbhadra\Coupons\Providers;

use Juzaweb\Support\ServiceProvider;
use Sbhadra\Coupons\Actions\MainAction;
use Illuminate\Support\Facades\Schema;

class CouponsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
        $this->registerAction([
            MainAction::class
        ]);
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
