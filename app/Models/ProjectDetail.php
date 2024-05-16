<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectDetail
 *
 * @property $id
 * @property $project_id
 * @property $chiller_id
 * @property $chiller_maximum_capacity
 * @property $chiller_minimum_capacity
 * @property $chilled_water_flow
 * @property $partial_load_25
 * @property $partial_load_50
 * @property $partial_load_75
 * @property $partial_load_100
 * @property $created_at
 * @property $updated_at
 *
 * @property Chiller $chiller
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;



    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'chiller_id',
        'chiller_maximum_capacity',
        'chiller_minimum_capacity',
        'chilled_water_flow',
        'partial_load_25',
        'partial_load_50',
        'partial_load_75',
        'partial_load_100'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chiller()
    {
        return $this->hasOne('App\Models\Chiller', 'id', 'chiller_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
