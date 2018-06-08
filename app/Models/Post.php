<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Post extends Authenticatable
{
    use Notifiable;

    protected $table = 'posts';

    protected $fillable = ['user_id', 'name', 'content', 'approver_id', 'approved_at', 'del_flg'];

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
