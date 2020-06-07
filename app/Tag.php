<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes,
        Traits\UsesUuid,
        Traits\HasReputation,
        Traits\RecordsActivity;

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
