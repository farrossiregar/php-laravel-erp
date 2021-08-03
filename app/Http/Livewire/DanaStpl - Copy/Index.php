<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Index extends Component
{
    use WithPagination;
    public $date, $region, $project;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        if(!check_access('dana-stpl.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        // dd(check_access_data('dana-stpl.approve-ms'));

        
        $data = \App\Models\DanaStpl::select('dana_stpl_master.*', 'region.region_code', 'employees.name')
                                    ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', 'dana_stpl_master.region_id')
                                    ->leftjoin(env('DB_DATABASE').'.employees as employees', 'employees.id', 'dana_stpl_master.sm_id')
                                    ->orderBy('dana_stpl_master.id', 'desc');
        if($this->date) $ata = $data->whereDate('dana_stpl_master.created_at',$this->date);
        if($this->region) $ata = $data->where('dana_stpl_master.region_id',$this->region);
        if($this->project) $ata = $data->where('dana_stpl_master.project_name',$this->project);
                        
        // dd($data->get());
        return view('livewire.dana-stpl.index')->with(['data'=>$data->paginate(50)]);
        
        
    }


}



