<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    protected $fillable = [
        'shel_address','shel_contact_1','shel_contact_2','shel_country','shel_latitude','shel_longitude','shel_name','shel_postal_code','shel_rating','shel_rooms','shel_status','user_id','shel_description','shel_pic','shel_city','website'
    ];
}
