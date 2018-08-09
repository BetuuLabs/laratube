<?php

namespace Betuulabs\Laratube\Facades;

use Illuminate\Support\Facades\Facade;

class Laratube extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laratube';
    }
}