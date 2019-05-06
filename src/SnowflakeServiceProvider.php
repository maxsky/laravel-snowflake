<?php

namespace Snowflake;

use Illuminate\Support\ServiceProvider;

class SnowflakeServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__ . '../config/snowflake.php' => base_path('config/snowflake.php'),
        ]);
    }

    public function register() {
        $this->app->singleton(Snowflake::class, function () {
            return new Snowflake();
        });
    }
}
