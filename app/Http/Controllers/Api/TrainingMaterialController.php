<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingMaterial;
use App\Models\TrainingMaterialEmployeeUpload;

class TrainingMaterialController extends Controller
{
    public function history()
    {
        $data = [];
        $param = TrainingMaterial::orderBy('id','DESC')->get();
        
        foreach($param as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['name'] = $item->name;
            $data[$k]['from_date'] = date('d F Y',strtotime($item->from_date));
            $data[$k]['end_date'] = date('d F Y',strtotime($item->end_date));
            $data[$k]['days'] = $item->days;
            $data[$k]['place'] = $item->place;
            $data[$k]['status'] = $item->status;
            $data[$k]['description'] = $item->description;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadImage(Request $r)
    {
        $data = TrainingMaterial::find($r->id);
        if($data){
            $upload = new TrainingMaterialEmployeeUpload();
            $upload->training_material_id = $data->id;
            $upload->employee_id = \Auth::user()->employee->id;
            $upload->description = $r->description;
            $upload->save();

            if($r->file){
                $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
                
                $name = $upload->id .".".$r->file->extension();
                $r->file->storeAs("public/training-material/{$data->id}", $name);
                $upload->image = "storage/training-material/{$data->id}/{$name}";
                $upload->save();
            }
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getImage($id)
    {
        $data = [];
        $temp = TrainingMaterialEmployeeUpload::where(['training_material_id'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] =  asset($item->image);
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}