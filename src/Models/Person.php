<?php

namespace Tupy\Contacts\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tupy\Contacts\Traits\HasContacts;

/**
 * Class People.
 * @package Tupy\Contacts\Models
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $rg
 * @property string $cpf
 * @property string $birth_date
 * @property string|null $observations
 * @property string|null $additional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Person extends Model
{
    use HasContacts;
    use SoftDeletes;

    protected $table = 'people';

    protected $fillable = [
        'first_name', 'last_name', 'gender', 'birth_date', 'observations', 'additional',
    ];

    protected static function booted()
    {
        static::deleting(function(Person $person){
            if (auth()->check()) {
                $person->deleted_by = auth()->id();
                $person->update();
            }
        });
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function getFirstAndLastNameAttribute()
    {
        $name = $this->full_name;

        $array = explode(" ", $name);
        $first_name = $array[0];

        if (count($array) > 1) {
            $last_name = $array[count($array) - 1];
        } else {
            $last_name = '';
        }

        $text = $first_name . ' ' . $last_name;

        return mb_convert_case($text, MB_CASE_TITLE, 'UTF-8');
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }
}
