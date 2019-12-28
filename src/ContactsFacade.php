<?php

namespace Tupy\Contacts;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tupy\Contacts\Skeleton\SkeletonClass
 */
class ContactsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'contacts';
    }
}
