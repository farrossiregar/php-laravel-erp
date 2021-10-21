<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Criteriacc extends Component
{    
    protected $listeners = [
        'modalcriteriacc'=>'criteriacc',
    ];
    public $selected_id, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public function render()
    {
        return view('livewire.vendor-management.criteriacc');        
    }

    public function criteriacc($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        
        $this->general_information                  = $this->data->general_information;
        $this->team_availability_capability         = $this->data->team_availability_capability;
        $this->tools_facilities                     = $this->data->tools_facilities;
        $this->ehs_quality_management               = $this->data->ehs_quality_management;
        $this->commercial_compliance                = $this->data->commercial_compliance;
        
        
    }
  
    public function save()
    {
        $user = \Auth::user();
       

        $data                                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $data->general_information                  = $this->general_information;
        $data->team_availability_capability         = $this->team_availability_capability;
        $data->tools_facilities                     = $this->tools_facilities;
        $data->ehs_quality_management               = $this->ehs_quality_management;
        $data->commercial_compliance                = $this->commercial_compliance;
        
        $data->save();


        session()->flash('message-success',"Criteria Commercial Compliance Successfully Evaluate!!!");
        
        return redirect()->route('vendor-management.index');
    }

    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        // if($hours > 0){
        //     $waktu = $hours.'.'.$minuts.' hours';
        //     // $waktu = $hours;
        // }else{
        //     $waktu = $minuts.' minute';
        //     // $waktu = $minuts;
        // }

        $waktu = '';
        if($months > 0){
            $waktu .= $months.' month ';
        }else{
            $waktu .= '';
        }

        if($days > 0){
            $waktu .= $days.' days';
        }else{
            $waktu .= '';
        }
        return $waktu;
    }
}