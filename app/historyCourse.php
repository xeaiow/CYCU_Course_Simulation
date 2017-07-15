<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class historyCourse extends Eloquent
{
    protected $collection = 'historycourse';
    protected $fillable = ['fb_id', 'CURS_NM_C_S', 'CURS_CODE', 'history_course'];
}
