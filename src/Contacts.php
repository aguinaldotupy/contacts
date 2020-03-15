<?php

namespace Tupy\Contacts;

class Contacts
{
    /**
     * @return array
     */
    public static function types()
    {
        return [
            [
                'label' => 'Email',
                'type' => 'email',
            ],
            [
                'label' => 'Telefone',
                'type' => 'text',
            ],
            [
                'label' => 'Telemóvel',
                'type' => 'text',
            ],
            [
                'label' => 'Skype',
                'type' => 'text',
            ],
            [
                'label' => 'Site',
                'type' => 'url',
            ],
            [
                'label' => 'Instagram',
                'type' => 'text',
            ],
            [
                'label' => 'Facebook',
                'type' => 'text',
            ],
            [
                'label' => 'Twitter',
                'type' => 'text',
            ],
            [
                'label' => 'Whatsapp',
                'type' => 'text',
            ],
            [
                'label' => 'Telegram',
                'type' => 'text',
            ],
            [
                'label' => 'Fax',
                'type' => 'text',
            ],
            [
                'label' => 'Outros',
                'type' => 'text',
            ],
        ];
    }
}
