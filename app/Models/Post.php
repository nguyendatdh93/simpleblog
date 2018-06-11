<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Post extends BaseModel
{
    // conts route name
    const ROUTE_LIST_POST = 'list_post';
    const ROUTE_ADD_POST = 'add_post';
    const ROUTE_SAVE_POST = 'save_post';
    const ROUTE_EDIT_POST = 'edit_post';

    protected $table = 'posts';

    protected $fillable = ['user_id', 'title', 'content', 'approver_id', 'approved_at', 'del_flg'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     *
     */
    public function approver()
    {
        return $this->belongsTo('App\Models\User', 'approver_id', 'id');
    }
}
