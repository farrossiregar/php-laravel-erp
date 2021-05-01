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
        // $this->validate($request,[
        //     'speed' => 'required'
        // ]);
        $data = new PpeCheck();
        $data->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
        $data->save();

        if($request->foto_dengan_ppe) {
            $name = "foto_dengan_ppe.".$request->foto_dengan_ppe->extension();
            $request->foto_dengan_ppe->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_dengan_ppe = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_banner) {
            $name = "foto_banner.".$request->foto_banner->extension();
            $request->foto_banner->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_banner = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_wah) {
            $name = "foto_wah.".$request->foto_wah->extension();
            $request->foto_wah->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_wah = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_elektrikal) {
            $name = "foto_elektrikal.".$request->foto_wah->extension();
            $request->foto_elektrikal->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_elektrikal = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_first_aid) {
            $name = "foto_first_aid.".$request->foto_first_aid->extension();
            $request->foto_first_aid->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_first_aid = "storage/ppe-check/{$data->id}/{$name}";
        }
        
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
