<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Post extends Authenticatable
{
    use Notifiable;

    protected $table = 'posts';

    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'name',
        'content',
        'approver_id',
        'approved_at',
        'del_flg'
    ];

    /**
     *
     */
//    public function user()
//    {
//        return $this->belongsTo('App\Models\User', 'id', 'user_id');
//    }

    /**
     *
     */
//    public function approver()
//    {
//        return $this->belongsTo('App\Models\User', 'id', 'approver_id');
//    }
}
