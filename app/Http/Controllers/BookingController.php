<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use App\Http\Resources\Booking as BookingResource;
use App\Http\Resources\BookingCollection;
use App\Http\Requests\StoreBooking;
use Illuminate\Support\Facades\Config;
use Validator;


class BookingController extends Controller
{
    //Get All Bookings
    public function index()
    {
        return new BookingCollection(Booking::all());
    }

    //Create Booking
    public function store(request $request)
    {
    	$validator = Validator::make($request->all(), [
           'name'      => 'required|max:255',
            'email'     => 'required|email',
            'address'   => 'required',
            'car_type'  => 'required',
       	]);
        
       	if ($validator->fails()) {
            Session::flash('error', $validator->messages()->first());
            return redirect()->back()->withInput();
       	}
     	$request['reference'] = $this->randomRefernce(); 
     
        $booking = booking::create($request->all());

    	 return (new BookingResource($booking))
    	 			->response()
    	 			->setStatusCode(201); 
    }

    //cancel Booking
    public function cancelBooking($reference)
    {

    	$booking = Booking::getBooking($reference);

    	$booking->status = Config::get('constants.status.status_cancel');
    	// dd($booking);
    	$booking->save();

    	return (new BookingResource($booking))
    	 			->response()
    	 			->setStatusCode(201);
    }

    //accept Booking
    public function acceptBooking($reference)
    {
    	$booking = Booking::getBooking($reference);
    	$booking->status = Config::get('constants.status.status_accepted');
    	$booking->save();

    	return (new BookingResource($booking))
    	 			->response()
    	 			->setStatusCode(201);
    }


    //generate random unique string
    public function randomRefernce(){

	     $reference = $this->quickRandom();

	     $validator = Validator::make(['reference'=>$reference],['reference'=>'unique:bookings,reference']);

	     if($validator->fails()){
	          return $this->randomId();
	     }

	     return $reference;
	}
	public function quickRandom($length = 8)
	{
    	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

  	  	return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}

}
