<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthCheck;
use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function store(Request $request)
    {
        $data = HealthCheck::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-md-'))->first();
        if(!$data) $data = new HealthCheck();
        
        $data->company = isset(\Auth::user()->employee->company->name) ? \Auth::user()->employee->company->name : '';
        $data->department = isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '';
        $data->lokasi_kantor = isset(\Auth::user()->employee->lokasi_kantor) ? \Auth::user()->employee->lokasi_kantor : '';
        $data->employee_id = \Auth::user()->employee->id;
        $data->status_bekerja = $request->status_bekerja;
        $data->kondisi_badan = $request->kondisi_badan;
        $data->tinggal_serumah_covid = $request->tinggal_serumah_covid;
        $data->bepergian_keluar_kota = $request->bepergian_keluar_kota;
        $data->mengunjungi_keluarga = $request->mengunjungi_keluarga;
        
        $data->is_submit = 1;
        $data->save();

        $data = HealthCheck::select('health_check.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->where('id',$data->id)->first();

        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function data()
    {
        $data = [];
        foreach(HealthCheck::where(['employee_id'=>\Auth::user()->employee->id])->get() as $k => $item){
            $data[$k] = $item;
            $data[$k]['date'] = date('d-M-Y',strtotime($item['created_at']));
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}