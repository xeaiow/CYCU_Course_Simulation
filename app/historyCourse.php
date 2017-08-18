<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class historyCourse extends Eloquent
{
    protected $collection = 'historycourse';
    protected $fillable = ['fb_id', 'history_course'];
    protected $hidden = ['fb_id'];
}
