<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
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
        return response()->json($response, 200);
    }
    public function getSites()
    {
        return response()->json(\App\Models\Site::get(), 200);
    }
    public function login(Request $r){
        
        if(Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            $user = Auth::user();
            $data['token'] =  $user->createToken('Laravel')->accessToken;
            $data['name'] = $user->name;
            return response()->json(['status'=>200,'message'=>'success','data'=> $data], 200);
        }
        else{
            return response()->json(['status'=>401,'message'=>'Unauthorised : '. $r->email. ' : '. $r->password], 200);
        }
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
