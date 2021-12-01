<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use Auth;
use DB;
use Session;


class Edit extends Component
{
    protected $listeners = [
        'modaleditcommitmentletter'=>'editcommitmentletter',
    ];

    public $selected_id, $dataproject, $company_name, $project, $region, $region_area, $ktp_id, $nik_pmt, $leader, $employee_name, $employeelist, $leaderlist, $regionarealist, $type_letter, $inputletter, $title_letter;

    public function render()
    {

    
        
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


        $getproject = \App\Models\ClientProject::where('id', $data->project)
                                                        ->where('company_id', $data->company_name)
                                                        ->where('is_project', '1')
                                                        ->first();

        // dd($getproject);

        $this->employeelist = \App\Models\Employee::whereIn('user_access_id', [85, 84])
                                                    ->where('region_id', $getproject->region_id)
                                                    ->where('project', $this->project)
                                                    ->get();

        $this->leaderlist = check_list_user_acc('commitment-letter.sm-list', $getproject->id);
        
    }
  
    public function save()
    {


        $data                   = CommitmentLetter::where('id', $this->selected_id)->first();
        // $data->company_name     = $_GET['company_id'];
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

        if($this->type_letter != $data->type_letter){
            $data->doc      = '';
        }

        $data->status           = '';
        $data->note           = '';

        $data->save();

        


        session()->flash('message-success',"Commitment Letter Berhasil diupdate");
        
        return redirect()->route('commitment-letter.index');
        // $link = "?company_id=".$data->company_name;
        // return redirect();
    }


}



