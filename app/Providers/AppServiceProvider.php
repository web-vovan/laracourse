<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Model::shouldBeStrict(!$this->app->isProduction());

        DB::listen(function ($query) {
            if ($query->time > 200) {
                logger()
                    ->channel('telegram')
                    ->warning('Слишком долго выполняется запрос: ' . $query->sql, $query->bindings);
            }
        });

        app(Kernel::class)->whenRequestLifecycleIsLongerThan(
            CarbonInterval::second(5),
            function () {
                logger()
                    ->channel('telegram')
                    ->warning('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );
    }
}
