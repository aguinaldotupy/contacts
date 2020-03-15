<?php

namespace Tupy\Contacts\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Tupy\Contacts\Models\Person;

/**
 * Trait HasPeoples.
 * @package Tupy\Contacts\Traits
 */
trait HasPeoples
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function peoples() :MorphMany
    {
        return $this->morphMany(Person::class, 'peopleable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function people() :MorphOne
    {
        return $this->morphOne(Person::class, 'peopleable');
    }
}
