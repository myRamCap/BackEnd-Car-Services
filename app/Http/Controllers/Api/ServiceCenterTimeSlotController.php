<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Http\Requests\StoreTimeSlotRequest;
use App\Http\Requests\UpdateTimeSlotRequest;
use App\Http\Resources\ServiceCenterTimSlotResource;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ServiceCenterTimeSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceCenterTimSlotResource::collection(
            TimeSlot::orderBy('id','desc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTimeSlotRequest $request)
    {
        $data = $request->validated();
        $timeslot = TimeSlot::create($data);
        return response(new ServiceCenterTimSlotResource($timeslot), 201);
    }

    public function timeslot($id, $year, $month, $day)
    {
        $date = $year.'/'.$month.'/'.$day;
        $carbonDate =  Carbon::parse($date);

        // $query = DB::select("SELECT id, service_center_id, time, max_limit, created_at  FROM time_slots
        // WHERE NOT EXISTS (
        //     SELECT a.time, addtime(a.time, b.estimated_time) as estimated_time 
        //     FROM bookings a INNER JOIN service_center_services b ON a.services_id = b.id
        //     WHERE time_slots.time >= a.time  AND time_slots.time < addtime(a.time, b.estimated_time) 
        //     AND a.service_center_id = $id AND a.booking_date =  '$date'
        // ) order by time ASC");

        // return($query);

        return ServiceCenterTimSlotResource::collection(
            DB::select("SELECT id, service_center_id, time, max_limit, created_at  FROM time_slots
                        WHERE NOT EXISTS (
                            SELECT a.time, addtime(a.time, b.estimated_time) as estimated_time 
                            FROM bookings a INNER JOIN service_center_services b ON a.services_id = b.service_id
                            WHERE time_slots.time >= a.time  AND time_slots.time < addtime(a.time, b.estimated_time) 
                            AND a.service_center_id = $id AND a.booking_date =  '$date'
                        ) order by time ASC" )
        );
 
        // return ServiceCenterTimSlotResource::collection(
        //     DB::select("SELECT id, service_center_id, time, max_limit, created_at  FROM time_slots
        //                 WHERE NOT EXISTS (
        //                     SELECT a.time, addtime(a.time, b.estimated_time) as estimated_time 
        //                     FROM bookings a INNER JOIN service_center_services b ON a.services_id = b.id
        //                     WHERE time_slots.time >= a.time  AND time_slots.time < addtime(a.time, b.estimated_time) 
        //                     AND a.service_center_id = $id AND a.booking_date =  ?
        //                 ) order by time ASC", [$carbonDate->format('Y-m-d')])
        // );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return ServiceCenterTimSlotResource::collection(
            TimeSlot::where('service_center_id', $id)->orderBy('id','desc')->get()
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTimeSlotRequest $request, TimeSlot $timeSlot)
    {
        $request->validated();

        $serviceCenterServices = TimeSlot::find($request->id);
        $serviceCenterServices->service_center_id = $request->service_center_id;
        $serviceCenterServices->time = $request->time; 
        $serviceCenterServices->max_limit = $request->max_limit; 
        $serviceCenterServices->save();
        return response(new ServiceCenterTimSlotResource($serviceCenterServices), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeSlot $timeSlot)
    {
        //
    }
}
