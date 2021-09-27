<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VehicleCheck;
use App\Models\VehicleCheckCleanliness;
use App\Models\VehicleCheckAccidentReport;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\AccidentReport;
use App\Models\AccidentReportImage;
use App\Models\EmployeeProject;

class VehicleCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$data){
            $data = new VehicleCheck();
            $data->employee_id = \Auth::user()->employee->id;
        }

        $employee = isset(\Auth::user()->employee->id) ? \Auth::user()->employee : '';
        if($employee){
            $data->region_id = $employee->region_id;
            $data->sub_region_id = $employee->sub_region_id;
            $project = EmployeeProject::where('employee_id',$employee->id)->first();
            if($project) $data->client_project_id = $project->client_project_id; 
        }

        $data->is_submit = 1;
        $data->plat_nomor = $request->plat_nomor;
        $data->stiker_safety_driving = $request->sticker_dipasang;
        $data->sticker_note = $request->sticker_note;
        $data->save();
        
        if($request->is_accident_report == 1){
            $accident = new AccidentReport();
            $accident->employee_id = \Auth::user()->employee->id;
            $accident->site_id = $request->site_id;
            $accident->date = date('Y-m-d',strtotime($request->date));
            $accident->jenis_insiden = $request->jenis_insiden;
            $accident->klasifikasi_insiden = $request->klasifikasi_insiden;
            $accident->rincian_kronologis = $request->rincian_kejadian;
            $accident->nik_and_nama = $request->nik_nama_kejadian;
            $accident->type = 2; // vehicle
            $accident->save();

            for($num=1;$num<=10;$num++){
                $img = "image_{$num}";
                if(isset($request->$img)){
                    $dataimage = new AccidentReportImage();
                    $dataimage->accident_report_id = $accident->id;
                    $ar = 'accident-report'.$accident->id.'-1.'.$request->$img->extension();
                    $request->$img->storeAs('public/Accident_Report/web/',$ar);
                    $dataimage->image = 'storage/Accident_Report/web/'.$ar;
                    $dataimage->save();
                }
            }
            
            $data->accident_report_id = $accident->id;
            $data->save();
        }

        // find notification
        $notification = Notification::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>\Auth::user()->employee->id,'type'=>3])->first();
        if($notification){
            $notification->is_read = 1;
            $notification->save();
        } 

        return response()->json(['message'=>'submited'], 200);
    }

    public function uploadVehicle(Request $r)
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new VehicleCheck();
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }

        if($r->file) {
            $name = "vehicle.".$r->file->extension();
            $r->file->storeAs("public/vehicle-check/{$find->id}", $name);
            $find->foto_mobil_plat_nomor = "storage/vehicle-check/{$find->id}/{$name}";
            $find->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function uploadSticker(Request $r)
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new VehicleCheck();
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }

        if($r->file) {
            $name = "sticker.".$r->file->extension();
            $r->file->storeAs("public/vehicle-check/{$find->id}", $name);
            $find->foto_stiker_safety_driving = "storage/vehicle-check/{$find->id}/{$name}";
            $find->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getLast()
    {
        $data = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        
        if($data){
            $data->foto_stiker_safety_driving = $data->foto_stiker_safety_driving ? asset($data->foto_stiker_safety_driving) : null;
            $data->foto_mobil_plat_nomor = $data->foto_mobil_plat_nomor ? asset($data->foto_mobil_plat_nomor) : null;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function history()
    {
        $param = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id,'is_submit'=>1])->orderBy('id','desc')->get();
        $data = [];
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['foto_mobil_plat_nomor'] = $item->foto_mobil_plat_nomor ? asset($item->foto_mobil_plat_nomor) : null;
            $data[$k]['foto_stiker_safety_driving'] = $item->foto_stiker_safety_driving ? asset($item->foto_stiker_safety_driving) : null;
            $data[$k]['date'] = date('d F Y',strtotime($item->created_at));
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadVehicleCleanliness(Request $r)
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new VehicleCheck();
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }

        $data = new VehicleCheckCleanliness();
        $data->vehicle_check_id = $find->id;
        $data->save();

        if($r->file){
            $name = $data->id.".".$r->file->extension();
            $r->file->storeAs("public/vehicle-check/{$find->id}/cleanliness/{$data->id}", $name);
            $data->image = "storage/vehicle-check/{$find->id}/cleanliness/{$data->id}/{$name}";
            $data->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function uploadVehicleAccidentReport(Request $r)
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new VehicleCheck();
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }

        $data = new VehicleCheckAccidentReport();
        $data->vehicle_check_id = $find->id;
        $data->save();

        if($r->file){
            $name = $data->id.".".$r->file->extension();
            $r->file->storeAs("public/vehicle-check/{$find->id}/accident-report/{$data->id}", $name);
            $data->image = "storage/vehicle-check/{$find->id}/accident-report/{$data->id}/{$name}";
            $data->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getVehicleAccidentReportById(VehicleCheck $id)
    {
        $data = [];
        foreach(VehicleCheckAccidentReport::where('vehicle_check_id',$id->id)->get() as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] = asset($item['image']);
        }
        $accidentReport = AccidentReport::find($id->accident_report_id);
        $accidentReportImage = [];
        foreach(AccidentReportImage::where('accident_report_id',$accidentReport->id)->get() as $k => $item){
            $accidentReportImage[$k]['image'] = asset($item->image);
        }
        
        return response()->json(['message'=>'success','data'=>$data,'accident_report'=>$accidentReport,'accident_report_image'=>$accidentReportImage], 200);
    }

    public function getVehicleCleanlinessById($id)
    {
        $data = [];
        foreach(VehicleCheckCleanliness::where('vehicle_check_id',$id)->get() as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] = asset($item['image']);
        }
           
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function getVehicleAccidentReport()
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        $data = [];
        if($find){
            foreach(VehicleCheckAccidentReport::where('vehicle_check_id',$find->id)->get() as $k => $item){
                $data[$k] = $item;
                $data[$k]['image'] = asset($item['image']);
            }
        }

       

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function getVehicleCleanliness()
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        $data = [];
        if($find){
            foreach(VehicleCheckCleanliness::where('vehicle_check_id',$find->id)->get() as $k => $item){
                $data[$k] = $item;
                $data[$k]['image'] = asset($item['image']);
            }
        }
        
            
        return response()->json(['message'=>'success','data'=>$data], 200);
    }
    
    public function deleteImage(Request $r)
    {
        $find = VehicleCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if($r->type==1){
            $find->foto_mobil_plat_nomor = null;
            $find->save();
        }

        if($r->type==2){
            $find->foto_stiker_safety_driving = null;
            $find->save();
        }

        if($r->type==3){
            VehicleCheckCleanliness::find($r->id)->delete();
        }

        if($r->type==4){
            VehicleCheckAccidentReport::find($r->id)->delete();
        }

        return response()->json(['message'=>'submited'], 200);
    }
}