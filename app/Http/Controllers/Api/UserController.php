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
     * Display a listing of the role corporate account.
     */
    public function corporate() {
        $corporate = User::where('role_id', 2)->get();
        return $corporate;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
 
        // return UserResource::collection(
        //     // Service::orderBy('id','desc')->get()
        //     User::join('roles', 'roles.id', '=', 'users.role')
        //     ->orderBy('users.id','desc')->get()
        //  ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt('welcome@123');
        $service_center = User::create($data);
        return response(new UserResource($service_center), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if ($id == 1) {
            return UserResource::collection(
                User::join('roles', 'roles.id', '=', 'users.role_id')
                ->select('users.*', 'roles.name')
                ->orderBy('users.id','desc')->get()
            ); 
        } else {
            return UserResource::collection(
                User::join('roles', 'roles.id', '=', 'users.role')
                    ->select('users.*', 'roles.name as role_name')
                    // ->where('users.role',)
                    ->orderBy('users.id','desc')->get()
             ); 
        }
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated();

        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->role_id = $request->role_id;
        // $user->password = bcrypt($request->role_id);
        $user->save();
        return response(new UserResource($user), 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
