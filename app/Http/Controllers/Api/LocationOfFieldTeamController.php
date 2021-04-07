<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LocationOfFieldTeam;
use Illuminate\Http\Request;

class LocationOfFieldTeamController extends Controller
{
    public function setActive()
    {
        Employee::where('id',\Auth::user()->employee->id)->update(['is_active_location'=>1]);

        return response()->json(['message'=>'submited'], 200);
    }

    public function setInactive()
    {
        Employee::where('id',\Auth::user()->employee->id)->update(['is_active_location'=>0]);

        return response()->json(['message'=>'submited'], 200);
    }

    public function checkActive()
    {
        $find = Employee::find(\Auth::user()->employee->id);

        return response()->json(['message'=>'submited','data'=>$find->is_active_location], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'lat' => 'required',
            'long' => 'required'
        ]);
        
        $data = new LocationOfFieldTeam();
        $data->employee_id = \Auth::user()->employee->id;
        $data->employee = \Auth::user()->employee;
        $data->lat = $request->lat;
        $data->long = $request->long;
        $data->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function check()
    {
        $data = LocationOfFieldTeam::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->orderBy('id','DESC')->first();

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
   
    public function data()
    {
        $employee = Employee::where('is_active_location',1)->get();
        $data  = [];
        
        foreach($employee as $e){
            $location = LocationOfFieldTeam::where('employee_id',$e->id)->orderBy('id','DESC')->first();
            if($location) $data[] = $location;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}
