<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\VehicleCheck as VehicleCheckModel;
use App\Models\AccidentReport;
use App\Models\AccidentReportImage;

class VehicleCheck extends Component
{
    public $employee_id,$site_id,$date,$klasifikasi_insiden,$jenis_insiden,$rincian_kronologis,$nik_and_nama,$foto_insiden=[];

    public function render()
    {
        $data = VehicleCheckModel::select('employees.name','vehicle_check.*')->orderBy('vehicle_check.id','DESC')->join('employees','employees.id','=','vehicle_check.employee_id');
        
        if($this->employee_id) $data->where('employee_id',$this->employee_id);

        return view('livewire.mobile-apps.vehicle-check')->with(['data'=>$data->paginate(100)]);
    }

    public function set_accident_report(AccidentReport $data)
    {
        $this->site_id = $data->site_id;
        $this->date = $data->date;
        $this->klasifikasi_insiden = $data->klasifikasi_insiden;
        $this->jenis_insiden = $data->jenis_insiden;
        $this->rincian_kronologis = $data->rincian_kronologis;
        $this->nik_and_nama = $data->nik_and_nama;
        $this->foto_insiden = AccidentReportImage::where(['accident_report_id'=>$data->id])->get();
    }
}
