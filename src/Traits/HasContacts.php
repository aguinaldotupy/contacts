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

    public function getMobileAttribute()
    {
        if ($contact = $this->contacts()->whereType('Celular')->first()) {
            return $contact->value;
        }

        return null;
    }

    public function getEmailContactAttribute()
    {
        if ($contact = $this->contacts()->whereType('Email')->first()) {
            return $contact->value;
        }

        return null;
    }

    public function getPhoneAttribute()
    {
        if ($contact = $this->contacts()->whereType('Telefone')->first()) {
            return $contact->value;
        }

        return null;
    }

    public function setContact(string $type, string $value) : \Illuminate\Database\Eloquent\Model
    {
        return $this->contacts()->create([
            'type' => $type,
            'value' => $value,
        ]);
    }

    public function updateContact(string $type, string $value)
    {
        if ($contact = $this->contacts()->whereType($type)->first()) {
            $contact->value = $value;
            $contact->update();

            return $contact;
        }

        return null;
    }
}
