<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;
use App\Models\AssetDatabase;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $filterproject, $employee_name;
    public $is_regional,$is_hq_ga,$is_hq_user;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = AssetDatabase::where('source_asset', 'request')->where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');
        if($this->is_regional || $this->is_hq_user) $data->where('region', \Auth::user()->employee->region_id);
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->filterproject) $data->where('client_project_id',$this->filterproject);                        
        
        return view('livewire.asset-request.data')->with(['data'=>$data->paginate(50)]);   
    }

    public function mount()
    {
        $this->is_regional = check_access('is-regional');
        $this->is_hq_user = check_access('is-hq-user');
        $this->is_hq_ga = check_access('is-hq-ga');
    }

    public function checkdata($id)
    {
        $check = \App\Models\DophomebaseMaster::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }
}