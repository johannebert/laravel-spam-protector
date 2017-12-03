<?php

namespace JohannEbert\LaravelSpamProtector\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Load package service provider
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array|\JohannEbert\LaravelSpamProtector\SpamProtectorServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return ['JohannEbert\LaravelSpamProtector\SpamProtectorServiceProvider'];
    }

    /**
     * Load package alias
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'SpamProtector' => 'JohannEbert\LaravelSpamProtector\SpamProtectorFacade',
        ];
    }
}