<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;

class SitesController extends Controller
{
    public function getAll()
    {
        $temp = Site::whereNotNull('name')->where('name','<>',"")->paginate(30);
        $data = [];
        foreach($temp as $k => $item){
            $data[$k] = $item;
        }

        return response()->json($data, 200);
    }

    public function getByFieldTeam()
    {
        $temp = Site::where('employee_id',\Auth::user()->employee->id)->paginate(20);
        $data = [];
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['region_name'] = isset($item->region->region) ? $item->region->region : '';
            $data[$k]['cluster_name'] = isset($item->cluster->name) ? $item->cluster->name : '';   
            $data[$k]['cluster_sub_name'] = isset($item->cluster_sub->name) ? $item->cluster_sub->name : '';   
        }

        return response()->json(["message"=>"success","data"=>$data], 200);
    }
}
