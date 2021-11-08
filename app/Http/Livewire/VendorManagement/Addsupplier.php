<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Addsupplier extends Component
{    
    protected $listeners = [
        'modaladdsupplier'=>'addsupplier',
    ];

    public $selected_id, $project_name, $project_pic, $project_category, $supplier1_id, $supplier2_id, $supplier3_id, $suppliername, $datasupplier, $supplier_category, $data, $supptype, $project_id;

    public function render()
    {

        $datasupplier = \App\Models\VendorManagement::orderBy('id', 'desc')->where('supplier_category', $this->selected_id);

        if($this->suppliername) $datasupplier->where('supplier_name', 'like', '%' . $this->suppliername . '%');
        $this->datasupplier = $datasupplier->get();

        // dd($this->datasupplier);
        return view('livewire.vendor-management.addsupplier');        
    }

    public function addsupplier($id){
        $this->selected_id = $id[0];
        $this->supptype = $id[1];
        $this->project_id = $id[2];
        
        

    }
   

    public function choosesupp($id, $supptype, $project_id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$project_id)->first();
        // dd($supptype);
        if($supptype == 1){
            $check->supplier1_id = $id;
        }

        if($supptype == 2){
            $check->supplier2_id = $id;
        }

        if($supptype == 3){
            $check->supplier3_id = $id;
        }
        // $d = json_encode($this->supplier1_id);
        // $check->supplier1_id = substr($d, 6, 1);
        $check->save();
        
        return redirect()->route('vendor-management.index');
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


        session()->flash('message-success',"Supplier Berhasil diinput");
        
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