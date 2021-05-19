<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CommitmentDaily;
use App\Models\PpeCheck;
use App\Models\VehicleCheck;
use App\Models\HealthCheck;
use App\Models\ToolsCheck;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function allUser(){
        $response = [
            'success' => true,
            'data'    => \App\Models\User::all(),
            'message' => 'OKE',
        ];
        return response($response, 200);
    }
    
    public function login(Request $r){
        
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken('Laravel')->accessToken;
            $data['name'] = $user->name;
            $data['email'] = isset($user->employee->email) ? $user->employee->email : '';
            $data['telepon'] = isset($user->employee->telepon) ? $user->employee->telepon : '';
            $data['address'] = isset($user->employee->address) ? $user->employee->address : '';
            $data['nik'] = isset($user->employee->nik) ? $user->employee->nik : '';
            $data['perusahaan'] = isset($user->employee->company->name) ? $user->employee->company->name : '';
            $data['lokasi_kantor'] = isset($user->employee->lokasi_kantor) ? $user->employee->lokasi_kantor : '';
            $data['department'] = isset($user->employee->department->name) ? $user->employee->department->name : '';
            $data['is_commitment_daily'] = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('employee_id', $user->employee->id)->count();
            $data['is_ppe_check'] = PpeCheck::whereDate('created_at',date('Y-m-d'))->where('employee_id', $user->employee->id)->count();
            $data['is_vehicle_check'] = VehicleCheck::whereDate('created_at',date('Y-m-d'))->where('employee_id', $user->employee->id)->count();
            $data['commitment_daily'] = CommitmentDaily::select('commitment_dailys.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->whereDate('created_at',date('Y-m-d'))->where('employee_id',$user->employee->id)->first();
            $data['is_health_check'] = HealthCheck::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->count();
            $data['health_check'] = HealthCheck::select('health_check.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->first();
            $data['is_tools_check'] = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m'),'is_submit'=>1])->count();

            return response(['status'=>200,'message'=>'success','data'=> $data], 200);
        }
        else{
            return response(['status'=>401,'message'=>'Unauthorised : '. $r->email. ' : '. $r->password], 200);
        }
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function update(Request $r)
    {
        $employee = Employee::find(\Auth::user()->employee->id);
        if($employee){
            $employee->name = $r->name;
            $employee->nik = $r->nik;
            $employee->telepon = $r->telepon;
            $employee->email = $r->email;
            $employee->address = $r->address;
            $employee->save();
        }
        return response()->json(['message' =>'success'], 200);
    }
}
