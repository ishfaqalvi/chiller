<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class Customer
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 * @property $mobile_number
 * @property $address
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Customer extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasApiTokens;

    protected $guard = 'customers';

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'job_title',
        'company',
        'employees',
        'mobile_number',
        'country',
        'image',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setImageAttribute($image)
    {
        if ($image) {
            $this->attributes['image'] = uploadFile($image, 'profile', '100', '100');
        } else {
            unset($this->attributes['image']);
        }
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getImageAttribute($image)
    {
        return isset($image) ? asset($image) : '';
    }
}