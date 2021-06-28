<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;
use App\Models\Notification;

class WorkOrderController extends Controller
{
    public function notification()
    {
        $general_notification = Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereIn('type',[1,2,3])->whereDate('created_at',date('Y-m-d'))->count();
        $general_notification += Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereNotIn('type',[1,2,3])->count();

        $open_work_order = PoTrackingNonms::whereNull('bast_status')->count();
        $accepted_work_order = PoTrackingNonms::where('bast_status',1)->orWhere('bast_status',3)->count();
        $closed_work_order = PoTrackingNonms::where('bast_status',2)->count();

        return response()->json(['message'=>'success','general_notification'=>$general_notification,'open_work_order'=>$open_work_order,'accepted_work_order'=>$accepted_work_order,'closed_work_order'=>$closed_work_order], 200);
    }

    public function workOrderGeneral()
    {
        $data = [];
        $key = 0;

        foreach(Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereIn('type',[1,2,3])->whereDate('created_at',date('Y-m-d'))->get() as $k => $item){
            $data[$key] = $item;
            $data[$key]['date'] = date('d-M-Y',strtotime($item->created_at));
            $key++;
        }

        $key++;
        
        foreach(Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereNotIn('type',[1,2,3])->get() as $k => $item){
            $data[$key] = $item;
            $data[$key]['date'] = date('d-M-Y',strtotime($item->created_at));
            $key++;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderOpen()
    {
        $data = [];
        $param = PoTrackingNonms::whereNull('bast_status')->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderAccepted()
    {
        $data = [];
        $param = PoTrackingNonms::where('bast_status',1)->orWhere('bast_status',3)->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderClosed()
    {
        $data = [];
        $param = PoTrackingNonms::where('bast_status',2)->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function data()
    {   
        $data = [];
        $param = PoTrackingNonms::get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadBastImage(Request $r)
    {
        $data = PoTrackingNonms::find($r->id);
        $bast = new PoTrackingNonmsBast();
        $bast->po_tracking_nonms_id = $data->id;
        $bast->description = $r->description;
        $bast->save();
        if($r->file){
            $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
            
            $name = $bast->id .".".$r->file->extension();
            $r->file->storeAs("public/po-tracking-nonms/{$data->id}", $name);
            $bast->image = "storage/po-tracking-nonms/{$data->id}/{$name}";
            $bast->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function submitBast(Request $r)
    {
        $data = PoTrackingNonms::find($r->id);
        $data->status = 5;
        $data->bast_status = 1;
        $data->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function getBast($id)
    {
        $data = [];
        $temp = PoTrackingNonmsBast::where(['po_tracking_nonms_id'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] =  asset($item->image);
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}