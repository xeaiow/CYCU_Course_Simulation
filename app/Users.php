<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $collection = 'users';
    protected $fillable = ['birthday', 'name', 'gender', 'photo', 'email', 'isImport', 'identify'];
    protected $hidden = ['fb_id'];
}
