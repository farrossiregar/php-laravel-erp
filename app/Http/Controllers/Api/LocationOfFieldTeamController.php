<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LocationOfFieldTeam;
use Illuminate\Http\Request;
use App\Models\LocationOfFieldTeamHistory;
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
        $position = LocationOfFieldTeam::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->first();

        return response()->json(['message'=>'success','data'=>$find->is_active_location,'lat'=>isset($position->lat)?$position->lat : '','long'=>isset($position->long) ? $position->long:''], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'lat' => 'required',
            'long' => 'required'
        ]);
        $data = LocationOfFieldTeam::where('employee_id',\Auth::user()->employee->id)->first();
        if(!$data)  $data = new LocationOfFieldTeam();
        $data->employee_id = \Auth::user()->employee->id;
        $data->employee = \Auth::user()->employee;
        $data->lat = $request->lat;
        $data->long = $request->long;
        $data->save();

        $data = LocationOfFieldTeamHistory::where('employee_id',\Auth::user()->employee->id)->first();
        $data = new LocationOfFieldTeamHistory();
        $data->employee_id = \Auth::user()->employee->id;
        $data->employee_raw = \Auth::user()->employee;
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
    
    public function getNearest(Request $r)
    {
        $find = LocationOfFieldTeam::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->first();
        
        if($find){
            $employee = Employee::where(function($table) use ($r){
                if($r->find_team) $table->where('name',"LIKE","%{$r->find_team}%");
            })->pluck('id')->toArray();
            
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
                                                                            cos(( `lat` * pi() / 180)) * cos((( {$find->long} - `long`) * pi()/180)))
                                                                    ) * 180/pi()
                                                                ) * 60 * 1.1515 * 1.609344
                                                            )
                                                        as distance FROM `location_of_field_teams`
                                                    ) location_of_field_teams
                                                    ".($employee?" WHERE employee_id in(".$employee.")" : '')." GROUP BY employee_id ORDER BY id DESC LIMIT 15"); 
            $data = [];
            $num = 0;
            foreach($locations as $location){
                $em = Employee::find($location->employee_id);

                if($location->employee_id == \Auth::user()->employee->id){
                    $data[$num]['id'] = $location->id;
                    $data[$num]['lat'] = $location->lat;
                    $data[$num]['long'] = $location->long;
                    $data[$num]['employee'] = 'My Location';
                    $data[$num]['telepon'] = isset($em->telepon) ? replace_phone_id($em->telepon) : '';
                    $data[$num]['employee_id'] = $location->employee_id;
                    $data[$num]['distance'] = round($location->distance,2);
                    $num++;
                }else{
                    $data[$num]['id'] = $location->id;
                    $data[$num]['lat'] = $location->lat;
                    $data[$num]['long'] = $location->long;
                    $data[$num]['employee'] = isset($em->name) ? $em->name : '';
                    $data[$num]['telepon'] = isset($em->telepon) ? replace_phone_id($em->telepon) : '';
                    $data[$num]['employee_id'] = $location->employee_id;
                    $data[$num]['distance'] = round($location->distance,2);
                    $num++;
                }
            }
        } 

        \LogActivity::add('[apps] Location of Field Team Data');
        
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
