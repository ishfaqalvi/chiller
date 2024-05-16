<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Project
 *
 * @property $id
 * @property $customer_id
 * @property $number_of_chillers
 * @property $building_minimum_load
 * @property $building_maximum_load
 * @property $chilled_water_differential
 * @property $created_at
 * @property $updated_at
 *
 * @property Customer $customer
 * @property ProjectDetail[] $projectDetails
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'project_number',
        'number_of_chillers',
        'building_minimum_load',
        'building_maximum_load',
        'chilled_water_differential'
    ];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->project_number = 'IN-' . str_pad($model->id, 6, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne('App\Models\Customer', 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany('App\Models\ProjectDetail', 'project_id', 'id');
    }
}
