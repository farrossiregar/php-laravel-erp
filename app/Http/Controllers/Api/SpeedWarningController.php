<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpeedWarningAlarm;
use Illuminate\Http\Request;
use App\Models\EmployeeProject;
 
class SpeedWarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'speed' => 'required'
        ]);

        $data = new SpeedWarningAlarm();
        $data->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
        $data->employee = \Auth::user()->employee;
        $data->speed = $request->speed;
        $data->lat = $request->lat;
        $data->long = $request->long;

        $employee = isset(\Auth::user()->employee->id) ? \Auth::user()->employee : '';
        if($employee){
            $data->region_id = $employee->region_id;
            $data->sub_region_id = $employee->sub_region_id;
            $project = EmployeeProject::where('employee_id',$employee->id)->first();
            if($project) $data->client_project_id = $project->client_project_id; 
        }

        $data->save();

        if(isset(\Auth::user()->employee->pic_speed->telepon)){
            $msg = "*Speed Warning Alarm*\n\n";
            $msg .= "Sdr/i ".\Auth::user()->employee->name ." sudah melebihi batas maksimum kecepatan berkendara, yaitu ".get_setting('speed_limit') ."km/h";

            send_wa(['message'=>$msg,'phone'=>\Auth::user()->employee->pic_speed->telepon]);
        }
        
        \LogActivity::add('[apps] Speed Warning Store');
        
        return response()->json(['message'=>'submited'], 200);
    }

    public function data() 
    {
        $result['code'] = 200;
        $result['message'] = 'success';
        $data = SpeedWarningAlarm::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->paginate(5);
        $temp = [];
        foreach($data as $k => $item){
            $temp[$k] = $item;
            $temp[$k]['date'] = date('d-M-Y',strtotime($item->created_at));
            $temp[$k]['time'] = date('H:i:s',strtotime($item->created_at));
        }

        $result['data'] = $temp;
        $result['today_warning'] = SpeedWarningAlarm::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->count();
        $result['max_speed'] = get_setting('speed_limit');
        $result['minutes_store_speed'] = 1;
        
        \LogActivity::add('[apps] Speed Warning Data');
        
        return response()->json($result, 200);
    }
}
