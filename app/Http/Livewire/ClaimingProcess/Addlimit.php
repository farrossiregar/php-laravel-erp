<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;

use Session;

class Addlimit extends Component
{

    use WithFileUploads;
    public $selected_id, $data;
    public $claim_category, $user_access, $limit_ent, $limit_med, $limit_trans, $limit_park, $year, $project, $region, $employee_name, $dataproject, $dataemployee;


    
    public function render()
    {
        $this->dataproject = [];
        $this->dataemployee = [];
        if($this->region){
            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                                            ->where('region_id', $this->region)
                                                            // ->where('region_id', Session::get('company_id'))
                                                            ->where('is_project', '1')
                                                            ->get();
            
            if($this->project){
                $this->dataemployee = \App\Models\EmployeeProject::select('employees.name', 'employees.nik')
                                                    ->where('employee_projects.client_project_id', $this->project)
                                                    ->leftjoin('employees','employee_projects.employee_id', '=', 'employees.id')
                                                    ->get();
            }
        }
        return view('livewire.claiming-process.addlimit');
        
    }

  
    public function save()
    {
        $data                           = new \App\Models\ClaimingProcessLimit();
       
        // $data->claim_category           = $this->claim_category;
        // $data->user_access              = $this->user_access;
        // $data->limit                    = $this->limit;
        // $data->year                     = $this->year;
        // $data->region                   = $this->region;
        // $data->project                  = $this->project;
        $data->employee_name            = \App\Models\Employee::where('nik',$this->employee_name)->first()->name;
        $data->nik                      = $this->employee_name;
        $data->entertainment            = $this->limit_ent;
        $data->medical                  = $this->limit_med;
        $data->transport                = $this->limit_trans;
        $data->parking                  = $this->limit_park;
        
      
        $data->save();
        
        session()->flash('message-success',"Claim Limit Berhasil ditambahkan");
        
        return redirect()->route('claiming-process.index');
        
    }

    
}
