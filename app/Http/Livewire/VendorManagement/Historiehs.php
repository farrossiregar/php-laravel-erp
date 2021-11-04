<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Historiehs extends Component
{    
    // protected $listeners = [
    //     'modalcriteriaehs'=>'criteriaehs',
    // ];
    public $selected_id, $date, $data, $datavm, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public $value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9, $value10, $value11, $value12, $value13, $value14, $value15;
    public $value, $service_type7;

    public function render()
    {
        // dd(\App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->get());
        // $this->value;
        // foreach(\App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->get() as $item){
        //     // $team[$i] = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
        //     // $this->idteam[$i] = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
        //     // $this->value[$i] = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->value;
        //     $this->value[$item->id_detail] = $item->value;
            
        // }
        // dd($this->value);
        
        return view('livewire.vendor-management.historiehs');        
    }


    public function mount()
    {
        
        $this->value1 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->value;
        $this->value2 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->value;
        $this->value3 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->value;
        $this->value4 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->value;
        $this->value5 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->value;
        $this->value6 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->value;
        $this->value7 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->value;
        $this->value8 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->value;
        $this->value9 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->value;
        $this->value10 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->value;
        $this->value11 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->value;
        $this->value12 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->value;
        $this->value13 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->value;
        $this->value14 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->value;
        $this->value15 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '15')->first()->value;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();

        $this->service_type7 = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->id_detail_title;
    }
  
    public function save()
    {
        $user = \Auth::user();
       
        for($i = 1; $i < 16; $i++){
            $data                                       = \App\Models\VendorManagementehs::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
            $data->id_supplier                          = $this->selected_id;
            $data->id_detail                            = $i;
            if($i == 7){
                $data->id_detail_title                      = $this->service_type7;
            }
            
            $data->value                                 = $this->valueconcat('value', $i);
            $data->save();
        }

        

        $update                             = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $update->ehs_company_structure      = ($this->value1 == 1 ? 10 : 0);
        $update->ehs_project_management     = ($this->value2 == 1 ? 10 : 0);
        $update->ehs_qualitymanagement      = ($this->value3 == 1 ? 5 : 0);
        $update->ehs_training               = ($this->value4 == 1 ? 5 : 0);
        $update->ehs_reporting              = ($this->value5 == 1 ? 10 : 0);
        $update->ehs_documentation          = ($this->value6 == 1 ? 10 : 0);

        $value8 = (($this->value8) ? 10 : 0);
        $value9 = (($this->value9) ? 10 : 0);
        $value10 = (($this->value10) ? 10 : 0);
        $value11 = (($this->value11) ? 5 : 0);
        $value12 = (($this->value12) ? 5 : 0);
        $value13 = (($this->value13) ? 5 : 0);
        $value14 = (($this->value14) ? 5 : 0);

        $update->ehs_certificate            = $value8 + $value9 + $value10 + $value11 + $value12 + $value13 + $value14;

        $update->ehs_quality_management =  $update->ehs_company_structure + $update->ehs_project_management + $update->ehs_qualitymanagement + $update->ehs_training + $update->ehs_reporting + $update->ehs_documentation + $update->ehs_certificate;
        $update->save();


        session()->flash('message-success',"Criteria EHS & Quality Management Successfully Evaluate!!!");
        
        return view('livewire.vendor-management.criteriaehs');  
    }

    public function updatedata($field, $id){
        $check = \App\Models\VendorManagementehs::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        
        $check->value = $this->valueconcat($field, $id);
        
        $check->save();

        session()->flash('message-success',"Criteria EHS & Quality Management Successfully Evaluate!!!");
        return view('livewire.vendor-management.criteriaehs');  
        
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