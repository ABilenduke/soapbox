<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use SoftDeletes,
        Traits\UsesUuid,
        Traits\RecordsActivity;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    public function liked()
    {
        return $this->morphTo();
    }
}
