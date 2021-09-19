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
        
        if($r->email =="" or $r->password == "") return response(['status'=>401,'message'=>'Unauthorised : '. $r->email. ' : '. $r->password], 200);
        
        if(is_numeric($r->email)){
            $field = 'nik';
        } elseif (filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }else{
            $field = 'email';
        }
        
        if(Auth::attempt([$field => $r->email, 'password' => $r->password])){

            if(\Auth::user()->employee->is_use_android==0) return response(['status'=>401,'message'=>'Unauthorised : '. $r->email. ' : '. $r->password], 200);

            Employee::find(\Auth::user()->employee->id)->update(['device_token'=>$r->device_token]);
            
            $data = $this->get_var_();
            
            return response(['status'=>200,'message'=>'success','data'=> $data], 200);
        }
        else{
            return response(['status'=>401,'message'=>'Unauthorised : '. $r->email. ' : '. $r->password], 200);
        }
    }

    public function get_var_()
    {
        $data = [];
        $user = Auth::user();
        $data['token'] =  $user->createToken('Laravel')->accessToken;
        $data['name'] = $user->name;
        $data['email'] = isset($user->employee->email) ? $user->employee->email : '';
        $data['photo'] = isset($user->employee->foto) ? asset($user->employee->foto) : null;
        $data['telepon'] = isset($user->employee->telepon) ? $user->employee->telepon : '';
        $data['address'] = isset($user->employee->address) ? $user->employee->address : '';
        $data['nik'] = isset($user->employee->nik) ? $user->employee->nik : '';
        $data['perusahaan'] = isset($user->employee->company->name) ? $user->employee->company->name : '';
        $data['lokasi_kantor'] = isset($user->employee->lokasi_kantor) ? $user->employee->lokasi_kantor : '';
        $data['department'] = isset($user->employee->department->name) ? $user->employee->department->name : '';
        $data['is_commitment_daily'] = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>$user->employee->id,'is_submit'=>1])->count();
        $data['is_ppe_check'] = PpeCheck::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>$user->employee->id,'is_submit'=>1])->count();
        $data['is_vehicle_check'] = VehicleCheck::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>$user->employee->id,'is_submit'=>1])->count();
        $data['commitment_daily'] = CommitmentDaily::select('commitment_dailys.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>$user->employee->id,'is_submit'=>1])->first();
        $data['is_health_check'] = HealthCheck::where(['employee_id'=>\Auth::user()->employee->id,'is_submit'=>1])->whereDate('created_at',date('Y-m-d'))->count();
        $data['health_check'] = HealthCheck::select('health_check.*',\DB::raw("DATE_FORMAT(created_at, \"%d %M %Y\") as tanggal"))->where(['employee_id'=>\Auth::user()->employee->id,'is_submit'=>1])->whereDate('created_at',date('Y-m-d'))->first();
        $data['is_tools_check'] = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m'),'is_submit'=>1])->count();
    
        return $data;
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function changePassword(Request $r)
    {
        $result = ['message'=>'success'];
        if(!\Hash::check($r->old_password, \Auth::user()->password)){
            $result['message'] = 'error';
            $result['data'] = 'Password yang anda masukan salah, silahkan dicoba kembali !';
        }elseif($r->new_password!=$r->confirm_new_password){
            $result['message'] = 'error';
            $result['data'] = 'Konfirmasi password salah silahkan dicoba kembali !';
        }else{
            $user = \Auth::user();
            $user->password = \Hash::make($r->new_password);
            $user->save();
            $result['data'] = 'Password berhasil dirubah !';
        }
        
        return response()->json($result, 200);
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
    
    public function uploadPhoto(Request $r)
    {
        $data = Employee::find(\Auth::user()->employee->id);
        if($data){
            if($r->file){
                $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
                
                $name = "photo.".$r->file->extension();
                $r->file->storeAs("public/photo/{$data->id}", $name);
                $data->foto = "storage/photo/{$data->id}/{$name}";
                $data->save();
            }
        }

        return response()->json(['message'=>'submited','photo'=>asset($data->foto)], 200);
    }

    public function checkToken()
    {
        return response()->json(['message'=>'success','data'=>$this->get_var_()], 200);
    }
}
