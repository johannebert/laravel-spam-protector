<?php

namespace JohannEbert\LaravelSpamProtector;

use Illuminate\Support\ServiceProvider;

class SpamProtectorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('spam-protector', function () {
            return new SpamProtector();
        });

        $this->app->alias(SpamProtector::class, 'spam-protector');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['spam-protector'];
    }
}
