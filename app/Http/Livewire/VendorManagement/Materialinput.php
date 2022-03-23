<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;
use DB;

class Materialinput extends Component
{    
    public $supplier_name, $supplier_pic, $supplier_contact, $supplier_email, $supplier_address, $price_offer, $project_name, $project_id, $dataproject;

    public function render()
    {
        $dataproject = \App\Models\ProjectEpl::orderBy('projects.id', 'desc')
                                    ->select('projects.*', 'region.region_code')
                                    ->join(env('DB_DATABASE').'.region', env('DB_DATABASE_EPL_PMT').'.projects.region_id', '=', env('DB_DATABASE').'.region.id' );
       
        if($this->project_name) $dataproject->where('projects.name', 'like', '%' . $this->project_name . '%');
        $this->dataproject = $dataproject->get();
        return view('livewire.vendor-management.materialinput');        
    }

    public function updated($propertyName)
    {
        if($propertyName=='customer_type')  $this->show_customer_type2 = $this->$propertyName=='Customer lain yang tidak disebutkan diatas:  *Free Text*' ? true : false;
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