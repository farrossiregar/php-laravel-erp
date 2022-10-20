<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HealthCheck;
use Illuminate\Http\Request;
use App\Models\EmployeeProject;

class HealthCheckController extends Controller
{
    public function store(Request $request)
    {
        $data = HealthCheck::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->first();
        if(!$data) $data = new HealthCheck();
        
        $data->company = $request->perusahaan == 1 ? 'PT. Putra Mulia Telecommunication' : 'PT. Harapan Utama Prima';
        $data->department = isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '';
        
        /**
         * Jika status bekerja di kantor 
         */
        if($request->status_bekerja=='Bekerja (hadir dikantor)'){
            switch($request->lokasi_kantor){
                case 1:
                    $data->lokasi_kantor = "Kantor Pusat (Duren Tiga, Jakarta)";
                    break;
                case 2:
                    $data->lokasi_kantor = "Kantor Cabang / Homebase";
                    break;
                default:
                    $data->lokasi_kantor = $request->lokasi_kantor;
                break;
            }
        }

        $employee = isset(\Auth::user()->employee->id) ? \Auth::user()->employee : '';
        if($employee){
            $data->region_id = $employee->region_id;
            $data->sub_region_id = $employee->sub_region_id;
            $project = EmployeeProject::where('employee_id',$employee->id)->first();
            if($project) $data->client_project_id = $project->client_project_id; 
        }
        
        $data->izin_others = $request->izin_others;
        $data->employee_id = \Auth::user()->employee->id;
        $data->status_bekerja = $request->status_bekerja;
        $data->status_bekerja_others = $request->status_bekerja_others;
        $data->kondisi_badan = $request->kondisi_badan;
        $data->kondisi_badan_sakit = $request->kondisi_badan_sakit;
        $data->tinggal_serumah_covid = $request->tinggal_serumah_covid;
        $data->tinggal_serumah_covid_ya = $request->tinggal_serumah_covid_ya;
        $data->bepergian_keluar_kota = $request->bepergian_keluar_kota;
        $data->bepergian_keluar_kota_ya = $request->bepergian_keluar_kota_ya;
        $data->mengunjungi_keluarga = $request->mengunjungi_keluarga;
        $data->mengunjungi_keluarga_ya = $request->mengunjungi_keluarga_ya;
        $data->is_submit = 1;
        $data->save();

        $data = HealthCheck::select('health_check.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->where('id',$data->id)->first();
        
        \LogActivity::add('[apps] Health Check Store');

        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function getToday()
    {
        $data = HealthCheck::select('health_check.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->where(['employee_id'=>\Auth::user()->employee->id,'is_submit'=>1])->whereDate('created_at',date('Y-m-d'))->first();
        
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function data()
    {
        $data = [];
        foreach(HealthCheck::where(['employee_id'=>\Auth::user()->employee->id])->get() as $k => $item){
            $data[$k] = $item;
            $data[$k]['date'] = date('d-M-Y',strtotime($item['created_at']));
        }

        \LogActivity::add('[apps] Health Check Data');

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}