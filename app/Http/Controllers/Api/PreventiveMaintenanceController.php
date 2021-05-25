<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveMaintenanceUpload;

class PreventiveMaintenanceController extends Controller
{
    public function history()
    {
        $data = [];
        $param = PreventiveMaintenance::orderBy('id','DESC')->get();
        
        foreach($param as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['status'] = $item->status;
            $data[$k]['site'] = isset($item->site->name) ? $item->site->name : '';
            $data[$k]['region'] = isset($item->site->region->region) ? $item->site->region->region : '';
            $data[$k]['project'] = isset($item->project->name) ? $item->project->name : '';
            $data[$k]['description'] = $item->description;
            $data[$k]['due_date'] = date('d F Y',strtotime($item->due_date));
            $data[$k]['start_date'] = date('d/M/Y',strtotime($item->start_date));
            $data[$k]['end_date'] = date('d/M/Y',strtotime($item->end_date));
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadImage(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);

        if($data and empty($data->start_date)){
            $data->start_date = date('Y-m-d');
            $data->status = 1; // on progress
            $data->save();
        }

        if($data){
            $upload = new PreventiveMaintenanceUpload();
            $upload->preventive_maintenance = $data->id;
            $upload->save();

            if($r->file){
                $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
                
                $name = $upload->id .".".$r->file->extension();
                $r->file->storeAs("public/preventive-maintenance/{$data->id}", $name);
                $upload->image = "storage/preventive-maintenance/{$data->id}/{$name}";
                $upload->description = $r->description;
                $upload->save();
            }
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getImage($id)
    {
        $data = [];
        $temp = PreventiveMaintenanceUpload::where(['preventive_maintenance'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] = $item->image ? asset($item->image) : null;
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function submit(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);
        
        if($data){
            $data->end_date = date('Y-m-d');
            $data->employee_id = \Auth::user()->employee->id;
            $data->status = 2; // complete
            $data->save();
        }

        return response()->json(['message'=>'submited','data'=>$data], 200);
    }
}