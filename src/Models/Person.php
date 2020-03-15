<?php

namespace Tupy\Contacts\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Tupy\Contacts\Traits\HasContacts;

/**
 * Class People.
 * @package Tupy\Contacts\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $birth_date
 * @property string|null $observations
 * @property string|null $additional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Person extends Model
{
    use HasContacts;

    protected $table = 'people';

    protected $fillable = [
        'first_name', 'last_name', 'gender', 'birth_date', 'observations', 'additional',
    ];

    protected $with = ['contacts', 'user'];

    public function peopleable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->morphOne(Person::class, 'userable');
    }
}
