<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appsCountry extends Model
{   
    protected $table = 'apps_countries';
    protected $fillable = [
        'country_name','country_code',
    ];
}
