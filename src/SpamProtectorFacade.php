<?php

namespace JohannEbert\LaravelSpamProtector;

use Illuminate\Support\Facades\Facade;

class SpamProtectorFacade extends Facade
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
