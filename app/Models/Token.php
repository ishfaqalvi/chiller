<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Token
 *
 * @property $id
 * @property $email
 * @property $otp
 * @property $expiry_time
 * @property $used
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Token extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','otp','expiry_time','used'];



}
