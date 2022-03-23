<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;

class Initialtoolsfacilities extends Component
{    
    public $selected_id, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;
    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14;
    public $value15, $value16, $value17, $value18, $value19, $value20, $value21, $value22, $value23;
    public $laptop_score=0,$vehicle_score=0,$generator_score=0,$special_tools_score=0,$warehouse_score=0,$dop_score=0,$total_score=0;
    public function render()
    {
        return view('livewire.vendor-management.initialtoolsfacilities');        
    }

    public function mount($id)
    {
        $this->selected_id = $id;
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
    }

    public function updated($propertyName)
    {
        $val13 = ($this->value13 != '' ? 1 : 0);
        $val14 = ($this->value14 != '' ? 1 : 0);
        $val15 = ($this->value15 != '' ? 1 : 0);
        $val16 = ($this->value16 != '' ? 1 : 0);
        $val17 = ($this->value17 != '' ? 1 : 0);
        $val18 = ($this->value18 != '' ? 1 : 0);
        $val19 = ($this->value19 != '' ? 1 : 0);

        $specialtools = $val13 + $val14 + $val15 + $val16 + $val17 + $val18 + $val19;

        $this->laptop_score = (isset($this->value1) ? 10 : 0);
        if($this->value2 == '' && $this->value3 == '' && $this->value4 == ''){
            $this->vehicle_score = 0;
        }else{
            $this->vehicle_score = 10;
        }
        if($this->value10 == '' && $this->value11 == '' && $this->value12 == ''){
            $this->generator_score = 0;
        }else{
            $this->generator_score = 15;
        }
        if($specialtools == 1){
            $this->special_tools_score = 10;
        }elseif($specialtools == 2){
            $this->special_tools_score = 15;
        }else{
            if($this->special_tools_score > 2){
                $this->special_tools_score = 20;
            }else{
                $this->special_tools_score = 0;
            }
        }
        if($this->value20){
            $this->warehouse_score = 10;
        }else{
            $this->warehouse_score = 0;
        }
        if($this->value21){
            $this->dop_score = 5;
        }else{
            $this->dop_score = 0;
        }

        $this->total_score = $this->laptop_score+$this->vehicle_score+$this->generator_score+$this->special_tools_score+$this->warehouse_score+$this->dop_score;
    }
  
    public function save()
    {
        for($i = 1; $i < 23; $i++){
            $data                                       = new \App\Models\VendorManagementtfinit();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            $data->value                                = $this->valueconcat('value', $i);
            $data->save();
        }

        $update                       = \App\Models\VendorManagement::where('id', $this->selected_id)->first();        
        $val13 = ($this->value13 != '' ? 1 : 0);
        $val14 = ($this->value14 != '' ? 1 : 0);
        $val15 = ($this->value15 != '' ? 1 : 0);
        $val16 = ($this->value16 != '' ? 1 : 0);
        $val17 = ($this->value17 != '' ? 1 : 0);
        $val18 = ($this->value18 != '' ? 1 : 0);
        $val19 = ($this->value19 != '' ? 1 : 0);

        $specialtools = $val13 + $val14 + $val15 + $val16 + $val17 + $val18 + $val19;

        $update->initial_tf_laptop = (isset($this->value1) ? 10 : 0);
        if($this->value2 == '' && $this->value3 == '' && $this->value4 == ''){
            $update->initial_tf_vehicle = 0;
        }else{
            $update->initial_tf_vehicle = 10;
        }
        if($this->value10 == '' && $this->value11 == '' && $this->value12 == ''){
            $update->initial_tf_generator = 0;
        }else{
            $update->initial_tf_generator = 15;
        }
        if($specialtools == 1){
            $update->initial_tf_special_tools = 10;
        }elseif($specialtools == 2){
            $update->initial_tf_special_tools = 15;
        }else{
            if($specialtools > 2){
                $update->initial_tf_special_tools = 20;
            }else{
                $update->initial_tf_special_tools = 0;
            }
        }

        if($this->value21){
            $update->initial_tf_warehouse = 10;
        }else{
            $update->initial_tf_warehouse = 0;
        }

        if($this->value22){
            $update->initial_tf_dop = 5;
        }else{
            $update->initial_tf_dop = 0;
        }

        $update->initial_tools_facilities = $update->initial_tf_laptop + $update->initial_tf_vehicle + $update->initial_tf_generator + $update->initial_tf_special_tools + $update->initial_tf_warehouse + $update->initial_tf_dop;
        $update->initial = $update->initial + ($update->initial_tools_facilities * 0.2);
        $update->save();

        session()->flash('message-success',"Initial Tools & Facilities Successfully Evaluate!!!");
        
        return redirect()->route('vendor-management.index');
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementtfinit::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        $check->save();

        session()->flash('message-success',"Initial Tools & Facilities Successfully Update!!!");
        return view('livewire.vendor-management.initialtoolsfacilities'); 
        
    }

    public function valueconcat($field, $i){
        $fields = $field.$i;
        return $this->$fields;
    }
}