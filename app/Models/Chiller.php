<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Chiller
 *
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chiller extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'model_id',
        'name',
        'chiller_maximum_capacity',
        'chiller_minimum_capacity',
        'chilled_water_flow',
        'partial_load_25',
        'partial_load_50',
        'partial_load_75',
        'partial_load_100',
        'customer_id',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand()
    {
        return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function model()
    {
        return $this->hasOne('App\Models\Models', 'id', 'model_id');
    }
}
