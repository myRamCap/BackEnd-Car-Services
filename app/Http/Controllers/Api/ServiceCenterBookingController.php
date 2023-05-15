<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\ServiceCenterBookingResource;
use Illuminate\Support\Facades\DB;

class ServiceCenterBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceCenterBookingResource::collection(
            Booking::join('service_centers', 'service_centers.id', '=', 'bookings.service_center_id')
                    ->join('services', 'services.id', '=', 'bookings.services_id')
                    ->join('vehicles', 'vehicles.id', '=', 'bookings.vehicle_id')
                    ->join('service_center_services', 'service_center_services.service_id', '=', 'bookings.services_id')
                    ->select('bookings.*', 'service_centers.name as service_center', 'services.name as service', 'vehicles.vehicle_name', 'service_center_services.estimated_time_desc')
                    ->orderBy('bookings.id','desc')
                    ->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {

        $data = $request->validated();
        // $booking = Booking::create($data);
        $time_encode = DB::select("select count(a.time) as time 
                from time_slots a
                inner join (
                    SELECT *
                    FROM time_slots
                    WHERE NOT EXISTS (
                        select a.time, addtime(a.time, b.estimated_time) as estimated_time from bookings a
                        inner join service_center_services b on a.services_id = b.id
                    WHERE (time_slots.time >= a.time  AND time_slots.time < addtime(a.time, b.estimated_time)  )
                    )
                ) b on a.time=b.time
                where a.time >= '$request->time' AND a.time < addtime('$request->time', '$request->estimated_time')"
        );

        $time_check = DB::select(" select count(time) as time  from time_slots a
        where a.time >= '$request->time'  AND a.time < addtime('$request->time', '$request->estimated_time')");
        if ($time_encode == $time_check) {
            $booking = Booking::create($data);
            return response(new ServiceCenterBookingResource($booking), 201);
        } else {
            return response([
                'errors' => [ 'time' => ['The Time is not available for the Service. Please Select another time slot']]
           ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $request->validated();

        $booking = Booking::find($request->id);
        $booking->customer_id = $request->customer_id;
        $booking->customer_name = $request->customer_name;
        $booking->vehicle_id = $request->vehicle_id;
        $booking->services_id = $request->services_id;
        $booking->service_center_id = $request->service_center_id;
        $booking->contact_number = $request->contact_number;
        $booking->status = $request->status;
        $booking->booking_date = $request->booking_date;
        $booking->time = $request->time;
        $booking->notes = $request->notes;
        $booking->save();
        return response(new ServiceCenterBookingResource($booking), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
