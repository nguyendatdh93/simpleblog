<?php

namespace App\Models;

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

}