<?php

namespace Tupy\Contacts\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = [
        'conctatable_type', 'conctatable_id', 'value', 'note', 'type'
    ];

    public function conctatable()
    {
        return $this->morphTo();
    }

    public function types()
    {
        return [
            'Email',
            'Telefone',
            'Celular',
            'Skype',
            'Site',
            'Instagram',
            'Facebook',
            'Twitter',
            'Whatsapp',
            'Telegram',
            'Fax'
        ];
    }
}
