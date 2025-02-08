<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    protected $table_name= 'polling_unit';

    protected $fillable= [
        'polling_unit_id',
        'ward_id',
        'uniquewardid',
        'polling_unit_number',
        'polling_unit_name',
        'polling_unit_description',
        'lat',
        'lon',
        'user_ip_address'
    ];
    //
}
