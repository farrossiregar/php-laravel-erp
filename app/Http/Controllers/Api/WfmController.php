<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkFlowManagement;
use App\Models\Notification;

class WfmController extends Controller
{
    public function history()
    {
        \LogActivity::add('[apps] WFM');
        
        $temp = WorkFlowManagement::where('employee_id',\Auth::user()->employee->id);

        $data = [] ;
        foreach($temp->get() as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['uploaded'] = date('d M Y',strtotime($item->created_at));
            $data[$k]['region'] = $item->region;
            $data[$k]['area'] = $item->servicearea4;
            $data[$k]['cluster'] = isset($item->cluster->name) ? $item->cluster->name : '' ;
            $data[$k]['status'] = $item->status;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function setPickup(Request $r)
    {
        $data = WorkFlowManagement::find($r->id);
        $data->status = 1;
        $data->pickup_date = date('Y-m-d H:i:s');
        $data->save();
        
        \LogActivity::add('[apps] WFM Pickup');

        return response()->json(['message'=>'success'], 200);
    }

    public function setSolved(Request $r)
    {
        $data = WorkFlowManagement::find($r->id);
        $data->status = 2; // solved
        $data->resolve_date = date('Y-m-d H:i:s');
        $data->note_solved = $r->note;
        $data->save();
        
        \LogActivity::add('[apps] WFM Solved');

        return response()->json(['message'=>'success'], 200);
    }

}