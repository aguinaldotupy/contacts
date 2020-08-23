<?php


namespace Tupy\Contacts\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tupy\Contacts\Traits\HasContacts;

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
    use HasContacts;
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'legal_name', 'trade_name', 'tax_number', 'ie_number', 'people_contact', 'additional'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    protected static function booted()
    {
        static::deleting(function(Company $company){
            if (auth()->check()) {
                $company->deleted_by = auth()->id();
                $company->update();
            }
        });
    }
}
