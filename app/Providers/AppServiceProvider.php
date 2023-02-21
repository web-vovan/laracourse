<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Services\Telegram\TelegramBotApi;
use Services\Telegram\TelegramBotApiContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        $this->app->bind(TelegramBotApiContract::class, TelegramBotApi::class);

        Model::shouldBeStrict(!$this->app->isProduction());

        DB::listen(function ($query) {
            if ($query->time > 1000) {
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
