<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingMaterial;
use App\Models\TrainingMaterialGroup;
use App\Models\TrainingMaterialGroupEmployee;
use App\Models\TrainingMaterialEmployeeUpload;
use App\Models\TrainingMaterialFile;
use App\Models\TrainingExam;
use App\Models\TrainingExamSubmit;
use App\Models\TrainingExamJawaban;
use Illuminate\Support\Arr;
use App\Models\TrainingExamResult;
use App\Models\EmployeeProject;

class TrainingMaterialController extends Controller
{
    public function history(Request $r)
    {
        $data = [];
        // get assing group
        $group = Arr::pluck(TrainingMaterialGroupEmployee::select('training_material_group_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'training_material_group_id');
        $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $param = TrainingMaterial::where(function($table) use($group){
                    $table->whereIn('training_material_group_id',$group)
                    ->orWhere('user_access_id',\Auth::user()->employee->user_access_id);
                })->whereIn('client_project_id',$client_project_ids)->orderBy('id','DESC');
        
        if(!empty($r->keyword)) $param = $param->where('name','LIKE',"%{$r->keyword}%");

        foreach($param->paginate(10) as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['date'] = date('d M Y',strtotime($item->created_at));
            $data[$k]['name'] = $item->name;
            $data[$k]['from_date'] = date('d F Y',strtotime($item->from_date));
            $data[$k]['end_date'] = date('d F Y',strtotime($item->end_date));
            $data[$k]['days'] = $item->days;
            $data[$k]['place'] = $item->place;
            $data[$k]['status'] = $item->status;
            $data[$k]['description'] = $item->description;
            $data[$k]['start_exam'] = $item->start_exam ? date('d M Y',strtotime($item->start_exam)) : '-';
            $data[$k]['end_exam'] = $item->end_exam ? date('d M Y',strtotime($item->end_exam)) : '-';
            $data[$k]['duration'] = $item->duration?$item->duration : 0;
            $data[$k]['duration_second'] = $item->duration?$item->duration*60 : 0;
            $data[$k]['total_soal'] = TrainingExam::where('training_material_id',$item->id)->count();
            $data[$k]['total_soal_uraian'] = TrainingExam::where(['training_material_id'=>$item->id,'jenis_soal'=> 1])->count();
            $data[$k]['total_soal_tunggal'] = TrainingExam::where(['training_material_id'=>$item->id,'jenis_soal'=> 2])->count();
            $data[$k]['total_soal_ganda'] = TrainingExam::where(['training_material_id'=>$item->id,'jenis_soal'=> 3])->count();
            $data[$k]['is_exam'] = 0;

            $result = TrainingExamResult::where(['training_material_id'=>$item->id,'employee_id'=>\Auth::user()->employee->id])->first();
            if($result){
                $data[$k]['is_exam'] = 1;
                $data[$k]['exam_nilai'] = $result->nilai;
                $data[$k]['exam_total_soal'] = $result->total_soal;
            }
        }

        \LogActivity::add('[apps] Training Data');

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

    public function getFile($id)
    {
        $data = [];
        $temp = TrainingMaterialFile::where(['training_material_id'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['file'] =  asset($item->file);
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
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

    public function getExam($id)
    {
        $data = [];
        $temp = TrainingExam::where(['training_material_id'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['soal'] = $item->soal;
            $data[$k]['jenis_soal'] = $item->jenis_soal;

            $jawaban = TrainingExamSubmit::where(['employee_id'=>\Auth::user()->employee->id,'training_material_id'=>$id,'training_exam_id'=>$item->id])->first();
            if($jawaban) 
                $data[$k]['jawaban'] = $jawaban->jawaban;
            else
                $data[$k]['jawaban'] = ""; 

            if($item->jenis_soal==2){
                $data[$k]['list_jawaban'] = TrainingExamJawaban::where('training_exam_id',$item->id)->get();
            }else{
                $data[$k]['list_jawaban'] = '';   
            }
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function storeJawaban(Request $r)
    {
        $data = TrainingExamSubmit::where(['employee_id'=>\Auth::user()->employee->id,'training_material_id'=>$r->training_material_id,'training_exam_id'=>$r->training_exam_id])->first();
        if(!$data){
            $data = new TrainingExamSubmit();
            $data->training_material_id = $r->training_material_id;
            $data->employee_id = \Auth::user()->employee->id;
            $data->training_exam_id = $r->training_exam_id;
        }
        
        $data->jawaban = $r->jawaban;
        $data->save();

        return response()->json(['message'=>'success'], 200);
    }

    public function submitJawaban(Request $r)
    {
        $find = TrainingExamResult::where(['training_material_id'=>$r->training_material_id,'employee_id'=>Auth::user()->employee->id])->first();
        
        if($find)  return response()->json(['message'=>'failed','data'=>'Kamu sudah melakukan submit training'], 200);

        $nilai = TrainingExamSubmit::select(\DB::raw('SUM(training_exam.nilai_soal) as total_nilai'))
                                ->join('training_exam','training_exam.id','=','training_exam_submit.training_exam_id')
                                ->where('training_exam_submit.jawaban',\DB::raw('training_exam.kunci_jawaban'))
                                ->where('training_exam_submit.employee_id',\Auth::user()->employee->id)
                                ->where('training_exam_submit.training_material_id',$r->training_material_id)
                                ->first();

        $data = new TrainingExamResult();
        $data->training_material_id = $r->training_material_id;
        $data->employee_id = \Auth::user()->employee->id;
        $data->nilai = $nilai?$nilai->total_nilai:0;
        $data->total_soal = TrainingExam::where('training_material_id',$r->training_material_id)->count();
        $data->save();

        return response()->json(['message'=>'success'], 200);
    }
}