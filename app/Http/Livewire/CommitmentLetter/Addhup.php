<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use Auth;
use DB;
use Session;


class Addhup extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $region, $region_area, $ktp_id, $nik_pmt, $leader, $employee_name, $employeelist, $leaderlist, $regionarealist, $type_letter, $inputletter, $title_letter;

    public function render()
    {
        
        // $this->company_name = Session::get('company_id');
        $company_name = Session::get('company_id');
        // dd($company_name);
        // if($company_name == '1' || $company_name == '2'){ 


            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                    ->where('company_id', Session::get('company_id'))
                                    ->where('is_project', '1')
                                    ->get();
            
            $this->regionarealist = [];
            $this->leaderlist = [];

            if($this->project){ 
                
                // $getproject = \App\Models\ProjectEpl::where('id', $this->project)->where('type', $this->company_name)->first();
                $getproject = \App\Models\ClientProject::where('id', $this->project)
                                                        ->where('company_id', Session::get('company_id'))
                                                        ->where('is_project', '1')
                                                        ->first();
                
                                                        // dd($getproject->region_id);

                $this->region = @\App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
                if($this->region){
                    $this->regionarealist = \App\Models\RegionCluster::where('region_id', $getproject->region_id)->orderBy('id', 'desc')->get();
                    
                }
                // $this->employeelist = check_list_user_acc('commitment-letter.tecme-list', $getproject->id);
                $this->employeelist = \App\Models\Employee::whereIn('user_access_id', [85, 84])
                                                            ->where('region_id', $getproject->region_id)
                                                            ->where('project', $this->project)
                                                            ->get();
                
                if($this->employee_name){
                    $this->ktp_id = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
                    $this->nik_pmt = isset(\App\Models\Employee::where('name', $this->employee_name)->first()->nik) ? \App\Models\Employee::where('name', $this->employee_name)->first()->nik : '' ;
                }
                
                $this->leaderlist = check_list_user_acc('commitment-letter.sm-list', $getproject->id);

            }else{
                $this->employeelist = [];
                $this->leader = [];
            }

            if($this->type_letter){
                // dd($this->type_letter);
                if($this->type_letter == '3'){
                    $this->inputletter = '1';
                }else{
                    $this->inputletter = '0';
                }
            }

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
        if($this->type_letter == '3'){
            $data->type_letter      = $this->title_letter;
        }else{
            $data->type_letter      = $this->type_letter;
        }
        

        // dd($this);

        $data->save();

       


        session()->flash('message-success',"Commitment Letter HUP Berhasil diinput");
        
        return redirect()->route('commitment-letter.index');
    }


}



