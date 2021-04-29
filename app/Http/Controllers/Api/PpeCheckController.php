<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PpeCheck;
use Illuminate\Http\Request;
 
class PpeCheckController extends Controller
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

        $data = new PpeCheck();
        $data->foto_dengan_ppe = $request->foto_dengan_ppe;
        $data->foto_banner = $request->foto_banner;
        $data->foto_wah = $request->foto_wah;
        $data->foto_elektrikal = $request->foto_elektrikal;
        $data->foto_first_aid = $request->foto_first_aid;
        $data->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';

        $data->save();

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
        
        return response()->json($result, 200);
    }
}
