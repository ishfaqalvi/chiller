<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CustomerBillingInformation
 *
 * @property $id
 * @property $customer_id
 * @property $street_address
 * @property $city
 * @property $province
 * @property $zip_code
 * @property $country
 * @property $phone_number
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CustomerBillingInformation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'customer_billing_informations';
    
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id','street_address','city','province','zip_code','country','phone_number'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }
}