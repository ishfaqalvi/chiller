<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Blog
 *
 * @property $id
 * @property $title
 * @property $thumbnail
 * @property $description
 * @property $detail
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Blog extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title','thumbnail','description','detail'];

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setThumbnailAttribute($image)
    {
        if ($image) {
            $this->attributes['thumbnail'] = uploadFile($image, 'blog', '1200', '660');
        } else {
            unset($this->attributes['thumbnail']);
        }
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getThumbnailAttribute($value)
    {
        return isset($value) ? asset($value) : '';
    }
}
