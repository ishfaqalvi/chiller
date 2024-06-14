<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Contact
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $phone
 * @property $message
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contact extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','phone','message'];



}
