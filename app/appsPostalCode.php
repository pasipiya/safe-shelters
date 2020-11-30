<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appsPostalCode extends Model
{
    protected $table = 'apps_postal_code';
    protected $fillable = [
        'country_code','postal_code','latitude','longitude'
    ];
}
