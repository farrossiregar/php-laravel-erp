<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Initialtoolsfacilities extends Component
{    
    protected $listeners = [
        'modalinitialtoolsfacilities'=>'initialtoolsfacilities',
    ];
    public $selected_id, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23;

    public function render()
    {
        return view('livewire.vendor-management.initialtoolsfacilities');        
    }

    // public function initialtoolsfacilities($id)
    // {
    //     $this->selected_id = $id;
        
    //     $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        
    //     $this->general_information                  = $this->data->general_information;
    //     $this->team_availability_capability         = $this->data->team_availability_capability;
    //     $this->tools_facilities                     = $this->data->tools_facilities;
    //     $this->ehs_quality_management               = $this->data->ehs_quality_management;
    //     $this->commercial_compliance                = $this->data->commercial_compliance;
        
        
    // }

    public function mount($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $datavm = \App\Models\VendorManagementtf::where('id_supplier', $this->selected_id);

        
    }
  
    public function save()
    {
        $user = \Auth::user();
       

        // $check                                       = \App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->first();
        // if(!$check){ 
            for($i = 1; $i < 24; $i++){
                $data                                       = new \App\Models\VendorManagementtf();
                $data->id_supplier                          = $this->selected_id;
                $data->id_detail                            = $i;
                // $data->id_detail_title                      = $this->valueconcat('service_type', $i);
                $data->value                                 = $this->valueconcat('value', $i);
                $data->save();
            }
        // }

        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        if($this->value2){
            $vehicles1 = 5;
        }else{
            $vehicles1 = 0;
        }

        if($this->value3){
            $vehicles2 = 5;
        }else{
            $vehicles2 = 0;
        }

        if($this->value4){
            $vehicles3 = 5;
        }else{
            $vehicles3 = 0;
        }

        $sumspecialtools = count(\App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->where('value', NULL)->get()) + count(\App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->where('value', '0')->get());
        // dd($sumspecialtools);

        $specialtools = 7 - $sumspecialtools;
        

        $update->tf_laptop = 10;
        $update->tf_vehicle = $vehicles1 + $vehicles2 + $vehicles3;
        $update->tf_generator = 10;

        if($specialtools == 1){
            $update->tf_special_tools = 10;
        }elseif($specialtools == 2){
            $update->tf_special_tools = 15;
        }else{
            if($specialtools > 2){
                $update->tf_special_tools = 20;
            }else{
                $update->tf_special_tools = 0;
            }
        }

        if($this->value21){
            $update->tf_warehouse = 10;
        }else{
            $update->tf_warehouse = 0;
        }

        $update->tools_facilities = $update->tf_laptop + $update->tf_vehicle + $update->tf_generator + $update->tf_special_tools + $update->tf_warehouse;

        $update->save();


        session()->flash('message-success',"Criteria Tools & Facilities Successfully Evaluate!!!");
        
        // return redirect()->route('vendor-management.index');
        return view('livewire.vendor-management.initialtoolsfacilities'); 
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementtf::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Criteria Tools & Facilities Successfully Update!!!");
        return view('livewire.vendor-management.initialtoolsfacilities'); 
        
    }

    public function valueconcat($field, $i){
        $fields = $field.$i;
        return $this->$fields;
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