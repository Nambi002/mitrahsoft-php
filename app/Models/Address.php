<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'email',
    'mobile',
    'address1',
    'address2',
    'city',
    'state',
    'country',
    'pincode'
];

}


