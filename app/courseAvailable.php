<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class courseAvailable extends Eloquent
{
    protected $collection = "courseavailable";
    protected $fillable = ['fb_id', 'course_lists', 'title', 'rnd_id'];
} 
