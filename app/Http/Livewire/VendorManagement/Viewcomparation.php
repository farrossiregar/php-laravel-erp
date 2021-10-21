<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Viewcomparation extends Component
{    
    protected $listeners = [
        'modalviewcomparation'=>'viewcomparation',
    ];

    public $selected_id, $supplier1_id, $supplier2_id, $supplier3_id;

    public function render()
    {
        return view('livewire.vendor-management.viewcomparation');        
    }

    public function viewcomparation($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagementCreateProject::where('id', $this->selected_id)->first();
        
        $this->supplier1_id                  = $this->data->supplier1_id;
        $this->supplier2_id                  = $this->data->supplier2_id;
        $this->supplier3_id                  = $this->data->supplier3_id;

        // $this->general_information                  = $this->data->general_information;
        // $this->team_availability_capability         = $this->data->team_availability_capability;
        // $this->tools_facilities                     = $this->data->tools_facilities;
        // $this->ehs_quality_management               = $this->data->ehs_quality_management;
        // $this->commercial_compliance                = $this->data->commercial_compliance;
        
        
    }
  
    public function save()
    {
        $user = \Auth::user();
       

        $data                                   = new \App\Models\VendorManagement();
        $data->supplier_name                    = $this->supplier_name;
        $data->supplier_pic                     = $this->supplier_pic;
        $data->supplier_contact                 = $this->supplier_contact;
        $data->supplier_email                   = $this->supplier_email;
        $data->supplier_address                 = $this->supplier_address;
        $data->price_offer                      = $this->price_offer;
        $data->supplier_category                = 'Material Supplier';
        $data->supplier_registration_date       = date('Y-m-d H:i:s');
        
        $data->created_at                       = date('Y-m-d H:i:s');
        $data->updated_at                       = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"Supplier Material / Tools Berhasil diinput");
        
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