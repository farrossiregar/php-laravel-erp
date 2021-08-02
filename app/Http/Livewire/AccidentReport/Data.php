<?php

namespace App\Http\Livewire\AccidentReport;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $date, $employee_id, $site_id, $klasifikasi_insiden, $jenis_insiden, $kronologis, $nik_and_nama;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        $data = \App\Models\AccidentReport::orderBy('id', 'desc');
        if($this->date) $ata = $data->whereDate('date',$this->date);
        if($this->employee_id) $ata = $data->where('employee_id',$this->employee_id);
        if($this->site_id) $ata = $data->where('site_id', 'like', '%' . $this->site_id . '%');
        if($this->klasifikasi_insiden) $ata = $data->where('klasifikasi_insiden', 'like', '%' . $this->klasifikasi_insiden . '%');
        if($this->jenis_insiden) $ata = $data->where('jenis_insiden', 'like', '%' . $this->jenis_insiden . '%');
        if($this->kronologis) $ata = $data->where('rincian_kronologis', 'like', '%' . $this->kronologis . '%');
        if($this->nik_and_nama) $ata = $data->where('nik_and_nama', 'like', '%' . $this->nik_and_nama . '%');
                        
        
        return view('livewire.accident-report.data')->with(['data'=>$data->paginate(50)]);

        
    }


}



