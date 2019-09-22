<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $fillable = ['name', 'email', 'address','car_type','reference'];
}
