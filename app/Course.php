<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Course extends Eloquent
{
    protected $collection = 'course';
}
