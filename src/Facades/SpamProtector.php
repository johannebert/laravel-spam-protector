<?php

namespace JohannEbert\LaravelSpamProtector\Facades;

use Illuminate\Support\Facades\Facade;

class SpamProtector extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'spam-protector';
    }
}
