<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceCenterRequest;
use App\Http\Requests\UpdateServiceCenterRequest;
use App\Http\Resources\ServiceCenterResource;
use App\Models\ServiceCenter;

class ServiceCenterController extends Controller
{
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCenter $serviceCenter)
    {
        //
    }
}
