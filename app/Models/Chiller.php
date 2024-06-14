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
        'formula',
        'customer_id',
        'status'
    ];

    // public function getElectricLoadAttribute()
    // {
    //     $capacities = [0.25, 0.5, 0.75, 1];
    //     $loads = [
    //         '25%' => $this->partial_load_25,
    //         '50%' => $this->partial_load_50,
    //         '75%' => $this->partial_load_75,
    //         '100%' => $this->partial_load_100
    //     ];

    //     $data = [];

    //     foreach ($capacities as $capacity) {
    //         $percentage = (int)($capacity * 100) . '%';
    //         $maximum_capacity = $this->chiller_maximum_capacity * $capacity;
    //         $data[$percentage] = [
    //             $maximum_capacity,
    //             $maximum_capacity / $loads[$percentage]
    //         ];
    //     }

    //     return $data;
    // }

    public function getElectricLoad($loadStep)
    {
        // Ensure the load step is within the chiller's maximum capacity
        if ($loadStep > $this->chiller_maximum_capacity) {
            return 0;
        }

        $capacities = [0.25, 0.5, 0.75, 1];
        $loads = [
            '25%' => $this->partial_load_25,
            '50%' => $this->partial_load_50,
            '75%' => $this->partial_load_75,
            '100%' => $this->partial_load_100
        ];

        foreach ($capacities as $capacity) {
            $percentage = (int)($capacity * 100) . '%';
            if ($loadStep <= $this->chiller_maximum_capacity * $capacity) {
                return $loadStep / $loads[$percentage];
            }
        }

        return 0; // Default case if nothing matches
    }


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
