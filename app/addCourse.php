<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class addCourse extends Eloquent
{
    protected $collection = 'userscourse';
    protected $fillable = ['fb_id', 'id', 'point', 'name', 'teacher', 'time_1', 'time_2', 'time_3', 'com_or_opt', 'class', 'phase', 'add_course'];
}
