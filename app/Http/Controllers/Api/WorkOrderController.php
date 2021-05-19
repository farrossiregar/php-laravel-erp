<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;

class WorkOrderController extends Controller
{
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
        $data->
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