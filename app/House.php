<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class House extends Eloquent
{
    protected $collection = "house";
    protected $fillable = ['fb_id', 'title', 'marker', 'floor', 'rent_price', 'door', 'space', 'landlord_gender', 'house_type', 'safe', 'extra_pay', 'cooking', 'landlord_score', 'live_score', 'landlord_comment', 'live_comment', 'pictures'];
    protected $hidden = ['fb_id'];
}
