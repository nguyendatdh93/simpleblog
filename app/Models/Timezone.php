<?php

namespace App\Models;

class Timezone extends BaseModel
{

    protected $table = 'user_timezone_settings';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
