<?php

namespace App\Models;

class Post extends BaseModel
{
    // conts route name
    const ROUTE_LIST_POST = 'list_post';
    const ROUTE_ADD_POST = 'add_post';
    const ROUTE_SAVE_POST = 'save_post';
    const ROUTE_EDIT_POST = 'edit_post';
    const ROUTE_REMOVE_POST = 'remove_post';

    protected $table = 'posts';

    protected $fillable = ['user_id', 'title', 'content', 'approver_id', 'approved_at', 'del_flg'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo('App\Models\User', 'approver_id', 'id');
    }
}
