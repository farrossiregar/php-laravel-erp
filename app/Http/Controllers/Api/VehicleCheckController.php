<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VechicleCheck;
use App\Models\VechicleCheckCleanliness;
use App\Models\VechicleCheckAccidentReport;
use Illuminate\Http\Request;
 
class VehicleCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = VechicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$data){
            $data = new VechicleCheck();
            $data->employee_id = \Auth::user()->employee->id;
        }
        $data->save();

        if($request->file_vehicle) {
            $name = $data->id.".".$request->file_vehicle->extension();
            $request->file_vehicle->storeAs("public/vechile-check/{$data->id}", $name);
            $data->file_vehicle = "storage/vehicle-check/{$data->id}/{$name}";
        }

        if($request->file_vehicle_cleanliness){
            foreach($request->file_vehicle_cleanliness as $file){
                $cleanliness = new VechicleCheckCleanliness();
                $cleanliness->vehicle_check_id = $data->id;
                $cleanliness->save();

                $name = $cleanliness->id.".".$file->extension();
                $file->storeAs("public/vechile-check/{$data->id}/{$cleanliness->id}", $name);
                $cleanliness->image = "storage/vehicle-check/{$data->id}/{$cleanliness->id}/{$name}";
                $cleanliness->save();
            }
        }

        if($request->file_vehicle_accident){
            foreach($request->file_vehicle_accident as $file){
                $accident = new VechicleCheckAccidentReport();
                $accident->vehicle_check_id = $data->id;
                $accident->save();

                $name = $accident->id.".".$file->extension();
                $file->storeAs("public/vechile-check/{$data->id}/{$accident->id}", $name);
                $accident->image = "storage/vehicle-check/{$data->id}/{$accident->id}/{$name}";
                $accident->save();
            }
        }
        
        $data->save();
        
        return response()->json(['message'=>'submited'], 200);
    }

    public function data(Request $request)
    {
        $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id])->get();

        if($request->year and $request->month){
            $find = ToolsCheck::where(['tahun'=>$request->year,'bulan'=>$request->month])->first();
            if($find) 
            $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id,'tools_check_id' => $find->id])->get();
        }

        $result = [];
        foreach($data as $k => $item){
            $result[$k] = $item;
            $result[$k]['image'] = asset($item->image);
        }
        
        return response()->json(['message'=>'submited','data'=>$data], 200);
    }
    
    public function deleteImage(Request $r)
    {
        ToolsCheckUpload::find($r->id)->delete();

        return response()->json(['message'=>'submited'], 200);
    }
}