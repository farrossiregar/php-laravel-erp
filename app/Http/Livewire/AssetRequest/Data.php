<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $filterproject, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\AssetDatabase::where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');                
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->filterproject) $data->where('client_project_id',$this->filterproject);                        
        
        return view('livewire.asset-request.data')->with(['data'=>$data->paginate(50)]);   
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