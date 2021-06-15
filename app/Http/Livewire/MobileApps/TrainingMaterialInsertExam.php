<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\TrainingMaterial;
use App\Models\TrainingExam;
use App\Models\TrainingExamJawaban;
use App\Models\TrainingExamSubmit;

class TrainingMaterialInsertExam extends Component
{
    public $data,$list_soal=[],$data_soal;
    public $soal=[],$jenis_soal=[],$list_jawaban=[],$kunci_jawaban=[],$nilai_soal=[],$alphabet,$duration,$start_exam,$end_exam;

    public function render()
    {
        return view('livewire.mobile-apps.training-material-insert-exam');
    }

    public function mount(TrainingMaterial $id)
    {
        $this->alphabet = range('A', 'Z');
        $this->data = $id;
        $this->data_soal = TrainingExam::where('training_material_id',$this->data->id)->get();
        $this->duration = 1; // minutes
        $this->add_soal();
    }

    public function delete_($k,$k_sub)
    {
        unset($this->list_jawaban[$k][$k_sub]);
    }

    public function delete_soal($k)
    {
        unset($this->list_soal[$k],$this->soal[$k],$this->jenis_soal[$k],$this->nilai_soal[$k],$this->list_jawaban[$k]);
    }

    public function add_jawaban($k)
    {
        $this->list_jawaban[$k][] = '';
        $this->emit('refresh-form');
    }

    public function add_soal()
    {
        $this->list_soal[] = '';
        $this->soal[] = '';
        $this->jenis_soal[] = '';
        $this->kunci_jawaban[] = '';
        $this->nilai_soal[] = 0;
        $this->list_jawaban[] = [];
        $this->emit('refresh-form');
    }

    public function save()
    {
        $this->validate([
            'soal.*' =>'required'
        ]);

        $this->data->duration = $this->duration;
        $this->data->start_exam = $this->start_exam;
        $this->data->end_exam = $this->end_exam;
        $this->data->save();

        foreach($this->list_soal as $k => $i){
            $data = new TrainingExam();
            $data->training_material_id = $this->data->id;
            $data->soal = $this->soal[$k];
            $data->jenis_soal = $this->jenis_soal[$k];
            $data->kunci_jawaban = $this->kunci_jawaban[$k]; 
            $data->nilai_soal = $this->nilai_soal[$k]; 
            $data->save();

            if($data->jenis_soal ==2){ // pilihan tunggal
                foreach($this->list_jawaban[$k] as $key_jawaban => $jawaban){
                    $insert_jawaban = new TrainingExamJawaban();
                    $insert_jawaban->training_exam_id = $data->id;
                    $insert_jawaban->jawaban = $jawaban;
                    $insert_jawaban->key = $key_jawaban;
                    $insert_jawaban->save();
                }
            }
        }

        session()->flash('message-success',"Exam Submited");

        return redirect()->to('mobile-apps');
    }
}
