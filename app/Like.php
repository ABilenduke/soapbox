<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use SoftDeletes, Traits\UsesUuid;

    public function liked()
    {
        return $this->morphTo();
    }
}
