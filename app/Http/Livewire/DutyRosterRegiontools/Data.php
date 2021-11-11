<?php

namespace App\Http\Livewire\DutyRosterRegiontools;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccidentReport;
use App\Models\RegionToolsHistory;

class Data extends Component
{
    use WithPagination;
    public $date, $employee_id, $keyword,$employees;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        $data = RegionToolsHistory::orderBy('id', 'desc');
        // if($this->date) $ata = $data->whereDate('date',$this->date);
        // if($this->employee_id) $ata = $data->where('employee_id',$this->employee_id);
        // if($this->keyword) $data->where(function($table){
        //     $table->where("site_id","LIKE","%{$this->keyword}%")
        //             ->orWhere('klasifikasi_insiden',"LIKE","%{$this->keyword}%")
        //             ->orWhere('jenis_insiden',"LIKE","%{$this->keyword}%")
        //             ->orWhere('rincian_kronologis',"LIKE","%{$this->keyword}%")
        //             ->orWhere('nik_and_nama',"LIKE","%{$this->keyword}%");
        // });
                        
        return view('livewire.duty-roster-regiontools.data')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $this->employees = AccidentReport::select(['employees.id','employees.name'])->join('employees','employees.id','=','accident_report.employee_id')->whereNotNull('employee_id')->groupBy('employee_id')->get();
    }
}



