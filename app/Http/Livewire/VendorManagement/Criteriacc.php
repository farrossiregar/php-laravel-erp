<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;

class Criteriacc extends Component
{    
 

    use WithPagination;
    public $selected_id, $value1, $value2, $value3, $value4, $note1, $note2, $note3, $note4, $data, $datavm;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        
        return view('livewire.vendor-management.criteriacc');        
    }


    public function mount($id){
        $this->selected_id = $id;

        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $this->datavm = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->first();
        $datavm2 = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id);
        // $this->value1 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->value;
        // $this->value2 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->value;
        // $this->value3 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->value;
        // $this->value4 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->value;


        // $this->note1 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->note;
        // $this->note2 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->note;
        // $this->note3 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->note;
        // $this->note4 = @\App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->note;

        // dd($this->note2);
    }

    
  
    public function save()
    {
        $user = \Auth::user();
       

        $check = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->first();
       
        for($i = 1; $i < 5; $i++){
            $data                   = new \App\Models\VendorManagementcc();
            $check = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->orderBy('id', 'desc')->first();
            if($check){
                $data->id           = ($check->id + 1);
                
            }
            $data->id_supplier      = $this->selected_id;
            $data->id_detail        = $i;
            $data->value            = $this->valueconcat('value', $i);
            $data->note             = $this->valueconcat('note', $i);
            $data->save();
        }

           
        

        $updatesupplier = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        if($this->value4){
            $value4 = 20;
        }else{
            $value4 = 0;
        }
        $updatesupplier->commercial_compliance = $this->value1 + $this->value2 + $this->value3 + $value4;

        // if($updatesupplier->scoring == '' || $updatesupplier->scoring == NULL){
            
        //     $updatesupplier->scoring = 0 + (($this->value1 + $this->value2 + $this->value3 + $value4) * 0.25);
        // }else{
        //     $updatesupplier->scoring = $updatesupplier->scoring + (($this->value1 + $this->value2 + $this->value3 + $this->value4) * 0.25);
        // }

        $updatesupplier->save();

        session()->flash('message-success',"Criteria Commercial Compliance Successfully Evaluate!!!");
        
        
        return view('livewire.vendor-management.criteriacc');
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