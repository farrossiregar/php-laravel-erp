<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CommitmentDaily;
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
            $data['is_commitment_daily'] = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('employee_id', $user->employee->id)->count();
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
}
