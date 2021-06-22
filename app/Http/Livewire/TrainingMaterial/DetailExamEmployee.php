<?php

namespace App\Http\Livewire\TrainingMaterial;

use Livewire\Component;
use App\Models\TrainingMaterial;
use App\Models\TrainingExam;
use App\Models\TrainingExamSubmit;
use App\Models\TrainingExamResult;

class DetailExamEmployee extends Component
{
    public $data,$list_soal,$data_soal,$alphabet,$result,$score;

    public function render()
    {
        return view('livewire.training-material.detail-exam-employee');
    }

    public function mount(TrainingMaterial $id,$employee_id)
    {
        $this->data = $id;
        $this->data_soal = TrainingExam::where('training_material_id',$this->data->id)->get();
        $this->list_soal = TrainingExamSubmit::where(['training_material_id'=>$this->data->id,'employee_id'=>$employee_id])->get();
        $this->result = TrainingExamResult::where(['training_material_id'=>$this->data->id, 'employee_id'=>$employee_id])->first();
        $this->alphabet = range('A', 'Z');
    }

    public function submit_score()
    {
        $this->validate([
            'score' =>'required'
        ]);

        $this->result->nilai = $this->score;
        $this->result->status = 1; // sudah diproses
        $this->result->save();

        session()->flash('message-success',__('Data processed successfully'));

        return redirect()->route('training-material.detail-exam',$this->data->id);
    }
}
