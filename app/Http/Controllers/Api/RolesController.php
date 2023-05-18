<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index() {
        return RoleResource::collection(
            Role::orderBy('name','asc')->get()
         ); 
    }
}
