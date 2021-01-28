<?php

namespace Hipig\LaravelTts;

use Illuminate\Support\ServiceProvider;

class TtsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/tts.php' => config_path('tts.php'),
        ], 'config');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Tts::class, function ($app) {
            return new Tts();
        });

        $this->app->alias(Tts::class, 'tts');

        $this->mergeConfigFrom(
            __DIR__.'/../config/tts.php',
            'tts'
        );
    }
}
