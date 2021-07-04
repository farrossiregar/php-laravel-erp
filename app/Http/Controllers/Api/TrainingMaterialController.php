<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingMaterial;
use App\Models\TrainingMaterialEmployeeUpload;
use App\Models\TrainingMaterialFile;
use App\Models\TrainingExam;
use App\Models\TrainingExamSubmit;
use App\Models\TrainingExamJawaban;
use App\Models\TrainingExamResult;

class TrainingMaterialController extends Controller
{
    public function history(Request $r)
    {
        $data = [];
        $param = TrainingMaterial::orderBy('id','DESC');
        
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
        $nilai = 0;
        $exam = TrainingExam::where(['training_material_id'=>$r->training_material_id])->get();
        foreach($exam as $k => $item){
            if($item->jenis_soal ==2){
                if($item->jawaban == $r->jawaban[$k][0]){
                    $nilai +=$item->nilai_soal;
                }
            }
        }

        $data = new TrainingExamResult();
        $data->training_material_id = $r->training_material_id;
        $data->employee_id = \Auth::user()->employee->id;
        $data->nilai = $nilai;
        $data->total_soal = TrainingExam::where('training_material_id',$r->training_material_id)->count();
        $data->save();

        return response()->json(['message'=>'success'], 200);
    }
}