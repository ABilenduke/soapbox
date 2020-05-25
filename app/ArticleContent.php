<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleContent extends Model
{
    use SoftDeletes, Traits\UsesUuid;
}
