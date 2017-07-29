<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class historyCourse extends Eloquent
{
    protected $collection = 'historycourse';
    protected $fillable = ['history_course'];
    protected $hidden = ['fb_id'];
}
