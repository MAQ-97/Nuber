<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    //
    protected $fillable = ['name', 'email', 'address','car_type','reference'];

    public static function getBooking($reference)
    {
    	return Booking::where('reference',$reference)->first();
    }
}
