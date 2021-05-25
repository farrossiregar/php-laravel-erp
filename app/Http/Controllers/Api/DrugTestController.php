<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrugTest;
use App\Models\DrugTestUpload;

class DrugTestController extends Controller
{
    public function history()
    {
        $data = [];
        $param = DrugTest::orderBy('id','DESC')->get();
        
        foreach($param as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['status_drug'] = $item->status_drug;
            $data[$k]['name'] = isset($item->employee->name) ? $item->employee->name : '';
            $data[$k]['telepon'] = isset($item->employee->telepon) ? $item->employee->telepon : '';
            $data[$k]['region'] = isset($item->employee->region->region) ? $item->employee->region->region : '';
            $data[$k]['project'] = isset($item->project->name) ? $item->project->name : '';
            $data[$k]['department'] = isset($item->employee->department_sub->name)?$item->employee->department_sub->name:'';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadImage(Request $r)
    {
        $data = DrugTest::find($r->id);
        if($data){
            $data->status_drug = $r->status_drug;
            $data->save();

            $upload = new DrugTestUpload();
            $upload->drug_test_id = $data->id;
            $upload->save();

            if($r->file){
                $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
                
                $name = $upload->id .".".$r->file->extension();
                $r->file->storeAs("public/drug-test/{$data->id}", $name);
                $upload->image = "storage/drug-test/{$data->id}/{$name}";
                $upload->save();
            }
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getImage($id)
    {
        $data = DrugTestUpload::where(['drug_test_id'=>$id])->first();
        if($data) $data->image = asset($data->image);

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}