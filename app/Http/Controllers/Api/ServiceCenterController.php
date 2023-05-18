<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceCenterRequest;
use App\Http\Requests\UpdateServiceCenterRequest;
use App\Http\Resources\ServiceCenterResource;
use App\Models\ServiceCenter;
use App\Models\ServiceCenterService;
use App\Models\TimeSlot;

class ServiceCenterController extends Controller
{

    public function getall () {
        $service_center = ServiceCenter::get();
        // $id = $service_center->id;
        // $services = ServiceCenterService::where('service_center_id', $service_center['id'])->get();
        foreach ($service_center as $service_center) {
            $services = ServiceCenterService::join('services', 'services.id', '=', 'service_center_services.service_id')
                        ->join('services_logos', 'services_logos.id', '=', 'services.image_id')
                        ->select('service_center_services.id', 'services.name', 'services.details', 'services_logos.image_url', 'service_center_services.estimated_time', 'service_center_services.estimated_time_desc' )
                        ->where('service_center_id', $service_center['id'])->get();
            $timeslot = TimeSlot::where('service_center_id', $service_center['id'])->get();
 

            return response([
                'service_center' => 
                    [
                        $service_center,
                        'services' => $services,
                        'timeSlot' => $timeslot
                    ]
           ], 202);
        }
       
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ServiceCenterResource::collection(
            ServiceCenter::orderBy('id','desc')->get()
            // ServiceCenter::join('services_logos', 'services_logos.id', '=', 'services.id')->orderBy('services.id','desc')->get()
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
    public function store(StoreServiceCenterRequest $request)
    {
        $data = $request->validated();
        $service_center = ServiceCenter::create($data);
        return response(new ServiceCenterResource($service_center), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceCenter $serviceCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceCenter $serviceCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceCenterRequest $request, ServiceCenter $serviceCenter)
    {
        $request->validated();

        $service_logo = ServiceCenter::find($request->id);
        $service_logo->name = $request->name;
        $service_logo->category = $request->category;
        $service_logo->country = $request->country;
        $service_logo->house_number = $request->house_number;
        $service_logo->barangay = $request->barangay;
        $service_logo->municipality = $request->municipality;
        $service_logo->province = $request->province;
        $service_logo->longitude = $request->longitude;
        $service_logo->latitude = $request->latitude;
        $service_logo->branch_manager_id = $request->branch_manager_id;
        $service_logo->image = $request->image;
        $service_logo->save();
        return response(new ServiceCenterResource($service_logo), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCenter $serviceCenter)
    {
        //
    }
}
