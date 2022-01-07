<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use App\Models\Employee;
use App\Models\RegionCluster;
use App\Models\ClientProjectRegion;
use Auth;
use Session;
use App\Models\ClientProject;

class Addhup extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;
    public $dataproject, $company_name, $project, $region, $region_area, $ktp_id, $nik_pmt, $leader, $employee_name, $employeelist, $leaderlist=[], $regionarealist=[], $type_letter, $inputletter, $title_letter;
    public $project_id,$region_id,$employee_id;

    public function render()
    {
            $this->dataproject = ClientProject::orderBy('id', 'desc')
                                    ->where('company_id', Session::get('company_id'))
                                    ->where('is_project', 1)
                                    ->get();

            $this->leaderlist = get_user_from_access('commitment-letter.sm-list');
            if($this->project_id)
                $this->regionarealist = ClientProjectRegion::select('region.*')
                                    ->where('client_project_id',$this->project_id)
                                    ->join('region','region.id','client_project_region.region_id')
                                    ->groupBy('region.id')
                                    ->get();

            // $this->regionarealist = [];
            // $this->leaderlist = [];

            // if($this->project){ 
                
            //     $getproject = \App\Models\ClientProject::where('id', $this->project)
            //                                             ->where('company_id', Session::get('company_id'))
            //                                             ->where('is_project', '1')
            //                                             ->first();
                
                                                        
            //     if($getproject){
            //         if($getproject->region_id){
            //             $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
            //         }else{
            //             $this->region = '';
            //         }
                    
            //     }else{
            //         $this->region = '';
            //     }

            //     if($this->region){
            //         $this->regionarealist = \App\Models\RegionCluster::where('region_id', $getproject->region_id)->orderBy('id', 'desc')->get();

            //     }else{
            //         $this->regionarealist = [];
            //     }

            //     $this->employeelist = \App\Models\Employee::whereIn('user_access_id', [85, 84])
            //                                                 ->where('region_id', $getproject->region_id)
            //                                                 ->where('project', $this->project)
            //                                                 ->get();
               
                 
                                                            
            //     if($this->employee_name){
            //         $this->ktp_id = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
            //         $this->nik_pmt = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
            //     }
                
            //     $this->leaderlist = check_list_user_acc('commitment-letter.sm-list', $getproject->id);

            // }else{
            //     $this->employeelist = [];
            //     $this->leader = [];
            // }

            // if($this->type_letter){
            //     // dd($this->type_letter);
            //     if($this->type_letter == '3'){
            //         $this->inputletter = '1';
            //     }else{
            //         $this->inputletter = '0';
            //     }
            // }

            // $this->regionarealist = RegionCluster::where('region_id', $getproject->region_id)->orderBy('id', 'desc')->get();
            $this->employeelist = Employee::whereIn('user_access_id', [85, 84])
                                                            ->join('employee_projects','employee_projects.employee_id','=','employees.id')
                                                            ->where(function($table){
                                                                if($this->region_id) $table->where('employees.region_id',$this->region_id);
                                                                if($this->project_id) $table->where('employee_projects.client_project_id',$this->project_id);
                                                            })->get();

        // }else{
        //     $this->dataproject = [];
        //     $this->project = [];
        //     $this->region = [];
        //     $this->regionarealist = [];
        //     $this->employeelist = [];
        //     $this->employee_name = [];
        //     $this->ktp_id = [];
        //     $this->nik_pmt = [];
        //     $this->leaderlist = [];
        //     $this->leader = [];
        // }

        return view('livewire.commitment-letter.addhup');
    }

    public function updated($propertyName)
    {
        $this->emit('updated',$this->employee_id);
    }
  
    public function save()
    {
        $data                   = new CommitmentLetter();
        $data->company_name     = Session::get('company_id');
        $data->project          = $this->project;
        $data->region           = $this->region;
        $data->region_area      = $this->region_area;
        $data->ktp_id           = @$this->ktp_id;
        $data->nik_pmt          = @$this->nik_pmt;
        $data->leader           = $this->leader;
        $data->employee_name    = $this->employee_name;
        $data->employee_id = $this->employee_id;
        $data->project_id = $this->project_id;
        $data->region_id = $this->region_id;
        if($this->type_letter == '3'){
            $data->type_letter      = $this->title_letter;
        }else{
            $data->type_letter      = $this->type_letter;
        }
        $data->createdby        = Auth::user()->name;
        $data->save();

        session()->flash('message-success',"Commitment Letter HUP Berhasil diinput");
        
        return redirect()->route('commitment-letter.index');
    }
}