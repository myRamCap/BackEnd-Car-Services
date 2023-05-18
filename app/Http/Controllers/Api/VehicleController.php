<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VehicleResource::collection(
            // Vehicle::orderBy('id','desc')->get()
            Vehicle::join('clients', 'clients.id', '=', 'vehicles.client_id')
            ->select('vehicles.*', 'clients.first_name', 'clients.last_name', 'clients.contact_number')
            ->orderBy('vehicles.id','desc')->get()
         ); 
    }

    public function vehicle($id)
    {
        return VehicleResource::collection(
            // Vehicle::where('client_id', $id)->orderBy('id','desc')->get()
            Vehicle::join('clients', 'clients.id', '=', 'vehicles.client_id')
            ->select('vehicles.*', 'clients.first_name', 'clients.last_name', 'clients.contact_number')
            ->where('vehicles.client_id', $id)->orderBy('vehicle_name','ASC')->get()
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
    public function store(StoreVehicleRequest $request)
    {
        $data = $request->validated();
        $service_center = Vehicle::create($data);
        return response(new VehicleResource($service_center), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return VehicleResource::collection(
            // Vehicle::where('client_id', $id)->orderBy('id','desc')->get()
            Vehicle::join('clients', 'clients.id', '=', 'vehicles.client_id')
            ->select('vehicles.*', 'clients.first_name', 'clients.last_name', 'clients.contact_number')
            ->where('vehicles.client_id', $id)->orderBy('vehicle_name','ASC')->get()
         ); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request)
    {
        $request->validated();

        $vehicle = Vehicle::find($request->id);
        $vehicle->client_id = $request->client_id;
        $vehicle->vehicle_name = $request->vehicle_name;
        $vehicle->chassis_number = $request->chassis_number;
        $vehicle->contact_number = $request->contact_number;
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->image = $request->image;
        $vehicle->notes = $request->notes;
        $vehicle->save();
        return response(new VehicleResource($vehicle), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
