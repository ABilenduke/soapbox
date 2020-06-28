<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    /**
     *
     * @var array
     */
    protected $guarded = [];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
