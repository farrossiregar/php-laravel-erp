<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use Auth;
use DB;


class Edit extends Component
{
    protected $listeners = [
        'modaleditcommitmentletter'=>'editcommitmentletter',
    ];

    public $selected_id, $dataproject, $company_name, $project, $region, $region_area, $ktp_id, $nik_pmt, $leader, $employee_name, $employeelist, $leaderlist, $regionarealist;

    public function render()
    {
        
        
        if($this->company_name){ 
            $this->dataproject = \App\Models\ProjectEpl::orderBy('projects.id', 'desc')
                                    ->select('projects.*', 'region.region_code')
                                    ->join(env('DB_DATABASE').'.region', env('DB_DATABASE_EPL_PMT').'.projects.region_id', '=', env('DB_DATABASE').'.region.id' )
                                    ->where('projects.type', $this->company_name)
                                    ->get();
            
            if($this->project){ 
                $getproject = \App\Models\ProjectEpl::where('id', $this->project)->where('type', $this->company_name)->first();
                
                $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
                if($this->region){
                    $this->regionarealist = \App\Models\RegionCluster::where('region_id', $getproject->region_id)->orderBy('id', 'desc')->get();
                    
                }
                $this->employeelist = check_list_user_acc('commitment-letter.tecme-list', $getproject->id);

                if($this->employee_name){
                    $this->ktp_id = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
                    $this->nik_pmt = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
                }
                
                $this->leaderlist = check_list_user_acc('commitment-letter.sm-list', $getproject->id);

            }else{
                $this->employeelist = [];
                $this->leader = [];
            }
        }else{
            $this->dataproject = [];
            $this->project = [];
            $this->region = [];
            $this->regionarealist = [];
            $this->employeelist = [];
            $this->employee_name = [];
            $this->ktp_id = [];
            $this->nik_pmt = [];
            $this->leaderlist = [];
            $this->leader = [];
        }

        return view('livewire.commitment-letter.edit');
    }

    public function editcommitmentletter($id)
    {
        $this->selected_id = $id;

        $data                   = CommitmentLetter::where('id', $this->selected_id)->first();
        
        $this->company_name     = $data->company_name;
        $this->project          = $data->project;
        $this->region           = $data->region;
        // $this->region_area      = \App\Models\RegionCluster::where('name', $data->region_area)->orderBy('id', 'desc')->first()->id;
        $this->region_area      = $data->region_area;
        $this->ktp_id           = $data->ktp_id;
        $this->nik_pmt          = $data->nik_pmt;
        $this->leader           = $data->leader;
        $this->employee_name    = $data->employee_name;
    }
  
    public function save()
    {


        $data                   = CommitmentLetter::where('id', $this->selected_id)->first();
        $data->company_name     = $this->company_name;
        $data->project          = $this->project;
        $data->region           = $this->region;
        $data->region_area      = $this->region_area;
        $data->ktp_id           = $this->ktp_id;
        $data->nik_pmt          = $this->nik_pmt;
        $data->leader           = $this->leader;
        $data->employee_name    = $this->employee_name;
        $data->status           = '';
        $data->note           = '';

        $data->save();

        


        session()->flash('message-success',"Commitment Letter Berhasil diinput");
        
        return redirect()->route('commitment-letter.index');
    }


}



