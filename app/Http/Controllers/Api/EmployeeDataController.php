<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeDataController extends Controller
{
    public function cities()
    {
        $cities = City::all();

        return response()->json($cities);
    }

    public function departments()
    {
        $departments = Department::all();

        return response()->json($departments);
    }
}
