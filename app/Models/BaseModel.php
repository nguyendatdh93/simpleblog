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

    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getPrimaryKeyName()
    {
        return with(new static)->getKeyName();
    }

    public static function getFillableColumns()
    {
        return with(new static)->getFillable();
    }

    public function getFillable()
    {
        return $this->fillable;
    }

}