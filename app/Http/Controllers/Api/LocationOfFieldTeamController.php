<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LocationOfFieldTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return response()->json(['message'=>'success','data'=>$find->is_active_location], 200);
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
    
    public function getNearest()
    {
        /*
        "
        SELECT * FROM (
            SELECT *, 
                (
                    (
                        (
                            acos(
                                sin((-6.292640 * pi() / 180))
                                *
                                sin(( `lat` * pi() / 180)) + cos(( -6.292640 * pi() /180 ))
                                *
                                cos(( `lat` * pi() / 180)) * cos((( 106.843668 - `long`) * pi()/180)))
                        ) * 180/pi()
                    ) * 60 * 1.1515 * 1.609344
                )
            as distance FROM `location_of_field_teams`
        ) location_of_field_teams
        
        LIMIT 15
        ";
        */

        $find = LocationOfFieldTeam::find(\Auth::user()->employee->id);
        

        if($find){
            $employee = Employee::where('is_active_location',1)->pluck('id')->toArray();
            
            $employee = json_encode($employee);
            $employee = rtrim($employee,']');
            $employee = ltrim($employee,'[');

            $locations = DB::select("SELECT * FROM (
                                                        SELECT *, 
                                                            (
                                                                (
                                                                    (
                                                                        acos(
                                                                            sin(({$find->lat} * pi() / 180))
                                                                            *
                                                                            sin(( `lat` * pi() / 180)) + cos(( {$find->lat} * pi() /180 ))
                                                                            *
                                                                            cos(( `lat` * pi() / 180)) * cos((( {$find->lat} - `long`) * pi()/180)))
                                                                    ) * 180/pi()
                                                                ) * 60 * 1.1515 * 1.609344
                                                            )
                                                        as distance FROM `location_of_field_teams`
                                                    ) location_of_field_teams
                                                    where distance <=10 ".($employee?" and employee_id in(".$employee.")" : '')." LIMIT 15");
        
            $data = [];
            foreach($locations as $k => $location){
                $em = Employee::find($location->employee_id)->first();
                if($em) {
                    $data[$k]['id'] = $location->id;
                    $data[$k]['lat'] = $location->lat;
                    $data[$k]['long'] = $location->long;
                    $data[$k]['employee'] = isset($em->name) ? $em->name : '';
                }
            }
        }
        
        return response()->json(['message'=>'success','data'=>isset($data)?$data:''], 200);

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
