<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Exam extends Eloquent
{
    protected $collection = "exams";
    protected $fillable = ['fb_id', 'filename', 'url', 'title', 'description'];
    protected $hidden = ['fb_id'];
}
