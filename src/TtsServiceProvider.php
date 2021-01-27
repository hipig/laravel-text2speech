<?php

namespace App\Providers;

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
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tts.php',
            'tts'
        );
    }
}
