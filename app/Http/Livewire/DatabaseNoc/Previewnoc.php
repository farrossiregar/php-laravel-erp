<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Previewnoc extends Component
{
    protected $listeners = [
        'modalpreview'=>'dataaccidentreport',
    ];
    use WithFileUploads;
    // public $site_id, $date, $employee_id, $klasifikasi_insiden, $jenis_insiden, $nikdannama, $rincian;
    // public $photo1, $photo2, $photo3, $photo4, $photo5, $photo6, $photo7, $photo8;

    public $test, $selected_id, $site_id, $employee_id, $date, $klasifikasi_insiden, $jenis_insiden, $rincian_kronologis, $nik_and_nama, $data, $dataimage;

    
    public function render()
    {
        
        return view('livewire.database-noc.previewnoc');
    }

    public function dataaccidentreport($id)
    {

        $this->selected_id              = $id;
        $this->data                     = \App\Models\AccidentReport::where('id', $this->selected_id)->first();
        $this->site_id                  = $this->data->site_id;
        $employee_id                    = \App\Models\Employee::where('id', $this->data->employee_id)->first();
        $this->employee_id              = @$employee_id['name'];
        $this->date                     = $this->data->date;
        $this->klasifikasi_insiden      = $this->data->klasifikasi_insiden;
        $this->jenis_insiden            = $this->data->jenis_insiden;
        $this->rincian_kronologis       = $this->data->rincian_kronologis;
        $this->nik_and_nama             = $this->data->nik_and_nama;

        // $this->dataimage                = \App\Models\AccidentReportImage::where('accident_report_id', $this->selected_id)->orderBy('id', 'asc')->get();
        // $this->photo1                   = $this->dataimage[0]->image;
        // $this->photo2                   = $this->dataimage[1]->image;
        // $this->photo3                   = $this->dataimage[2]->image;
        // $this->photo4                   = $this->dataimage[3]->image;
        // $this->photo5                   = $this->dataimage[4]->image;
        // $this->photo6                   = $this->dataimage[5]->image;
        // $this->photo7                   = $this->dataimage[6]->image;
        // $this->photo8                   = $this->dataimage[7]->image;
        
        
    }

   

}
