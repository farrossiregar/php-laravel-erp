<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use Session;

class Revisipettycash extends Component
{
    protected $listeners = [
        'modalrevisipettycash'=>'datarevise',
    ];

    use WithFileUploads;
    public $selected_id, $data;
    public $dataproject, $company_name, $project, $region, $petty_cash_category, $amount, $keterangan;
    
    public function render()
    {
        
       
        
        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        
        $this->regionarealist = [];
        $this->leaderlist = [];

        if($this->project){ 
            
            $getproject = \App\Models\ClientProject::where('id', $this->project)
                                                    ->where('company_id', Session::get('company_id'))
                                                    ->where('is_project', '1')
                                                    ->first();
            
                                                    
            if($getproject){
                if($getproject->region_id){
                    $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
                }else{
                    $this->region = '';
                }
                
            }else{
                $this->region = '';
            }

         

        }
        
        
        return view('livewire.petty-cash.revisipettycash');
        
    }

    public function datarevise($id){
        $this->selected_id              = $id;
        $data                           = \App\Models\PettyCash::where('id', $this->selected_id)->first();
        $this->project                  = $data->project;
        $this->region                   = $data->region;
        $this->petty_cash_category      = $data->petty_cash_category;
        $this->amount                   = $data->amount;
        $this->keterangan               = $data->keterangan;
       
    }
  
    public function save()
    {
        $data                           = \App\Models\PettyCash::where('id', $this->selected_id)->first();
        $data->company_id               = Session::get('company_id');
        $data->project                  = $this->project;
        $data->region                   = $this->region;
        $data->petty_cash_category      = $this->petty_cash_category;
        $data->amount                   = str_replace(',', '', str_replace('Rp', '', $this->amount));
        $data->keterangan               = $this->keterangan;
        $data->status                   = '';
        $data->note                     = '';
        
        $data->save();
        
        
        session()->flash('message-success',"Petty Cash Settlement Berhasil direvisi");
        
        return redirect()->route('petty-cash.index');
        
    }


    public function yearborn($year){
        if($year > substr(date('Y'), 2, 2)){
            return '19'.$year;
        }else{
            return '20'.$year;
        }

    }
}
