<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{
    use Notifiable;

    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     *
     */
    public function approver()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
