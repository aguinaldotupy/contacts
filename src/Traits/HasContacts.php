<?php

namespace Tupy\Contacts\Traits;

use Tupy\Contacts\Models\Contact;

trait HasContacts
{
    public function contacts()
    {
        return $this->morphMany(Contact::class, 'contactable');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }
}
