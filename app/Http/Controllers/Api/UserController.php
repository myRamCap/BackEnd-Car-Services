<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 
        // return UserResource::collection(
        //     // Service::orderBy('id','desc')->get()
        //     User::join('roles', 'roles.id', '=', 'users.role')
        //             ->orderBy('users.id','desc')->get()
        //  ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return UserResource::collection(
            User::join('roles', 'roles.id', '=', 'users.role')
                ->select('users.*', 'roles.name as role_name')
                ->where('users.role',)
                ->orderBy('users.id','desc')->get()
         ); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
