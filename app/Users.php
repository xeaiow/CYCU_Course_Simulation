<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $collection = 'users';
    protected $fillable = ['fb_id', 'birthday', 'name', 'gender', 'photo', 'isImport'];
}
