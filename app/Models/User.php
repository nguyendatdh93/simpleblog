<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel
{
    const ROUTE_SETTING_TIMEZONE_FORM = 'setting_timezone_form';
    const ROUTE_SAVE_TIMEZONE = 'save_timezone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'id', 'user_id');
    }
}
