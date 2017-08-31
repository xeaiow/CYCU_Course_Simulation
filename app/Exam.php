<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Exam extends Eloquent
{
    protected $collection = "Exam";
    protected $fillable = ['fb_id', 'filename', 'url'];
    protected $hidden = ['fb_id'];
}
