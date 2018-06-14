<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
class BaseModel extends Authenticatable
{
    use Notifiable;

    public $dateFormat = 'U';

    /**
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * @return mixed
     */
    public static function getPrimaryKeyName()
    {
        return with(new static)->getKeyName();
    }

    /**
     * @return mixed
     */
    public static function getFillableColumns()
    {
        return with(new static)->getFillable();
    }

    /**
     * @return array
     */
    public function getFillable()
    {
        return $this->fillable;
    }

    /**
     *
     */
    public static function boot()
    {
        static::creating(function($model)
        {
            $model->created_at = Carbon::now()->timestamp;
        });

        static::updating(function($model)
        {
            $model->updated_at = Carbon::now()->timestamp;
        });

        static::deleting(function($model)
        {
            $model->deleted_at = Carbon::now()->timestamp;
        });
    }

}