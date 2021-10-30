<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use Auth;

class Historicc extends Component
{    
    // protected $listeners = [
    //     'modalcriteriacc'=>'criteriacc',
    // ];


    use WithPagination;
    public $selected_id, $value1, $value2, $value3, $value4, $note1, $note2, $note3, $note4, $data, $datavm;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        
        return view('livewire.vendor-management.historicc');        
    }


    
  
    public function save()
    {
        $user = \Auth::user();
       

        $check = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->first();
        if($check){
            $data1                   = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first();
            $data1->value            = $this->value1;
            $data1->note             = $this->note1;
            $data1->save();


            $data2                   = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first();
            $data2->value            = $this->value2;
            $data2->note             = $this->note2;
            $data2->save();

            $data3                   = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first();
            $data3->value            = $this->value3;
            $data3->note             = $this->note3;
            $data3->save();

            $data4                   = \App\Models\VendorManagementcc::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first();
            $data4->value            = $this->value4;
            $data4->note             = $this->note4;
            $data4->save();
        }else{
            $data                   = new \App\Models\VendorManagementcc();
            $data->id_supplier      = $this->selected_id;
            $data->id_detail        = '1';
            $data->value            = $this->value1;
            $data->note             = $this->note1;
            $data->save();

            $data                   = new \App\Models\VendorManagementcc();
            $data->id_supplier      = $this->selected_id;
            $data->id_detail        = '2';
            $data->value           = $this->value2;
            $data->note            = $this->note2;
            $data->save();

            $data                   = new \App\Models\VendorManagementcc();
            $data->id_supplier      = $this->selected_id;
            $data->id_detail        = '3';
            $data->value           = $this->value3;
            $data->note            = $this->note3;
            $data->save();

            $data                   = new \App\Models\VendorManagementcc();
            $data->id_supplier      = $this->selected_id;
            $data->id_detail        = '4';
            $data->value           = $this->value4;
            $data->note            = $this->note4;
            $data->save();
        }
        

        $updatesupplier = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $updatesupplier->commercial_compliance = $this->value1 + $this->value2 + $this->value3 + $this->value4;

        if($updatesupplier->scoring == '' || $updatesupplier->scoring == NULL){
            $updatesupplier->scoring = 0 + (($this->value1 + $this->value2 + $this->value3 + $this->value4) * 0.25);
        }else{
            $updatesupplier->scoring = $updatesupplier->scoring + (($this->value1 + $this->value2 + $this->value3 + $this->value4) * 0.25);
        }

        $updatesupplier->save();

        session()->flash('message-success',"Criteria Commercial Compliance Successfully Evaluate!!!");
        
        // return redirect()->route('vendor-management.index');
        return view('livewire.vendor-management.criteriacc');
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