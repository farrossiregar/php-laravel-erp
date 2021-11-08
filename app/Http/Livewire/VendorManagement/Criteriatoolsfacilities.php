<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Criteriatoolsfacilities extends Component
{    
    protected $listeners = [
        'modalcriteriatoolsfacilities'=>'criteriatoolsfacilities',
    ];
    public $selected_id, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23;

    public function render()
    {
        return view('livewire.vendor-management.criteriatoolsfacilities');        
    }


    public function mount($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        

        
    }
  
    public function save()
    {
        $user = \Auth::user();
       

        for($i = 1; $i < 23; $i++){
            $data                                       = new \App\Models\VendorManagementtf();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            // $data->id_detail_title                   = $this->valueconcat('service_type', $i);
            $data->value                                = $this->valueconcat('value', $i);
            $data->save();
        }

        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();

        // $sumspecialtools = count(\App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->where('value', NULL)->get()) + count(\App\Models\VendorManagementtf::where('id_supplier', $this->selected_id)->where('value', '0')->get());

        // dd($sumspecialtools);
        // $specialtools = 7 - $sumspecialtools;
        
        $val13 = ($this->value13 != '' ? 1 : 0);
        $val14 = ($this->value14 != '' ? 1 : 0);
        $val15 = ($this->value15 != '' ? 1 : 0);
        $val16 = ($this->value16 != '' ? 1 : 0);
        $val17 = ($this->value17 != '' ? 1 : 0);
        $val18 = ($this->value18 != '' ? 1 : 0);
        $val19 = ($this->value19 != '' ? 1 : 0);

        $specialtools = $val13 + $val14 + $val15 + $val16 + $val17 + $val18 + $val19;

        $update->tf_laptop = (isset($this->value1) ? 10 : 0);
        // $update->tf_vehicle = $vehicles1 + $vehicles2 + $vehicles3;
        if($this->value2 == '' && $this->value3 == '' && $this->value4 == ''){
            $update->tf_vehicle = 0;
        }else{
            $update->tf_vehicle = 10;
        }

        if($this->value10 == '' && $this->value11 == '' && $this->value12 == ''){
            $update->tf_generator = 0;
        }else{
            $update->tf_generator = 15;
        }

        

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

        if($this->value22){
            $update->tf_dop = 5;
        }else{
            $update->tf_dop = 0;
        }

        $update->tools_facilities = $update->tf_laptop + $update->tf_vehicle + $update->tf_generator + $update->tf_special_tools + $update->tf_warehouse + $update->tf_warehouse;

        $update->save();


        session()->flash('message-success',"Criteria Tools & Facilities Successfully Evaluate!!!");
        
        // return redirect()->route('vendor-management.index');
        return view('livewire.vendor-management.criteriatoolsfacilities'); 
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementtf::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Criteria Tools & Facilities Successfully Update!!!");
        return view('livewire.vendor-management.criteriatoolsfacilities'); 
        
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