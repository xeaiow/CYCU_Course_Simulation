<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class House extends Eloquent
{
    protected $collection = "house";
    protected $fillable = ['fb_id', 'title', 'marker', 'price', 'floor', 'door', 'space', 'landlord_gender', 'house_type', 'safe', 'extra_pay', 'cooking', 'landlord_score', 'live_score', 'landlord_comment', 'live_comment'];
    protected $hidden = ['fb_id'];
}
