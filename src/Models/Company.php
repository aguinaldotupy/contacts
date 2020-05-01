<?php


namespace Tupy\Contacts\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * @package Tupy\Contacts\Models
 * @mixin \Eloquent
 * @property string $legal_name
 * @property string|null $trade_name
 * @property string|null $tax_number
 * @property string|null $ie_number
 * @property string|null $people_contact
 * @property string|null $additional
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'legal_name', 'trade_name', 'tax_number', 'ie_number', 'people_contact', 'additional'
    ];

//    protected $with = ['contacts'];
}
