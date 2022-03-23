<?php

namespace App\Http\Livewire\TrainingMaterial;

use Livewire\Component;
use App\Models\TrainingMaterial;
use App\Models\TrainingExam;
use App\Models\TrainingExamJawaban;
use App\Models\TrainingExamSubmit;

class DetailExam extends Component
{
    public $data,$list_soal=[],$data_soal;
    public $soal=[],$jenis_soal=[],$list_jawaban=[],$kunci_jawaban=[],$nilai_soal=[],$alphabet,$duration,$start_exam,$end_exam;

    public function render()
    {
        return view('livewire.training-material.detail-exam');
    }

    public function mount(TrainingMaterial $id)
    {
        $this->alphabet = range('A', 'Z');
        $this->data = $id;
        $this->data_soal = TrainingExam::where('training_material_id',$this->data->id)->get();
        $this->duration = 1; // minutes
    }
}
