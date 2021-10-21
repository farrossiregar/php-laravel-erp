<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Newproject extends Component
{    
    public $project_name, $project_pic, $project_category, $supplier1_id, $supplier2_id, $supplier3_id;

    public function render()
    {
        return view('livewire.vendor-management.newproject');        
    }

    
  
    public function save()
    {
        $user = \Auth::user();
       

        $data                                   = new \App\Models\VendorManagementCreateProject();
        $data->project_name                     = $this->project_name;
        $data->project_pic                      = $this->project_pic;
        $data->project_category                 = $this->project_category;
        $data->supplier1_id                     = $this->supplier1_id;
        $data->supplier2_id                     = $this->supplier2_id;
        $data->supplier3_id                     = $this->supplier3_id;
        
        
        $data->created_at                       = date('Y-m-d H:i:s');
        $data->updated_at                       = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"New Project Berhasil diinput");
        
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