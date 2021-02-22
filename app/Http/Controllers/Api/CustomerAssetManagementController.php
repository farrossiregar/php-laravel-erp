<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomerAssetManagementController extends Controller
{
    public function data(Request $r){

        $data = \App\Models\CustomerAssetManagement::paginate(10);

        return response()->json(['status'=>200,'data'=>$data], 200);
    }
}