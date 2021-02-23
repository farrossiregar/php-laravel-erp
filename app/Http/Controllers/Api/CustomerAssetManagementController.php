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

        $raw = \App\Models\CustomerAssetManagement::paginate(40);
        $data = [];
        foreach($raw as $k => $item)
        {
            $var = [];
            if(!isset($item->tower->name) or $item->tower->name=="") continue;
            $var['id'] = $item->id;
            $var['uploader'] = date('d F Y',strtotime($item->created_at));
            $var['tower'] = $item->tower->name;
            $var['site_id'] = isset($item->site->site_id) ? $item->site->site_id : '';
            $var['site'] = isset($item->site->name) ? $item->site->name : '';
            $var['region'] = isset($item->region->region) ? $item->region->region : '';
            $data[] = $var;
        }
        $json['current_page'] = 1;
        $json['data'] = $data;
        return response()->json(['status'=>200,'data'=>$data], 200);
    }
}