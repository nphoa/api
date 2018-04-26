<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\UpdateWork;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $updateWork = new UpdateWork();
        $updateWork->update();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
