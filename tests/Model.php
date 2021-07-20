<?php

namespace Lioneagle\LioneaglePaginator\Tests;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $fillable = ['name'];
}
