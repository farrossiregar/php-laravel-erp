<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Input extends Component
{    
    public $customer, $project_name, $quotation_number, $po_number, $region, $qty, $unit, $price_or_unit, $estimate_revenue, $duration, $brief_description, $startdate, $enddate, $date, $customer_type, $customer_type2, $show_customer_type2=false;

    public function render()
    {
        return view('livewire.vendor-management.input');        
    }

    public function updated($propertyName)
    {
        if($propertyName=='customer_type')  $this->show_customer_type2 = $this->$propertyName=='Customer lain yang tidak disebutkan diatas:  *Free Text*' ? true : false;
    }
  
    public function save()
    {
        $user = \Auth::user();
       

        $data                           = new \App\Models\BusinessOpportunities();
        $data->customer                 = $this->customer;
        $data->project_name             = $this->project_name;
        $data->quotation_number         = $this->quotation_number;
        $data->po_number                = $this->po_number;
        $data->region                   = $this->region;
        $data->qty                      = $this->qty;
        $data->unit                      = $this->unit;
        $data->price_or_unit            = str_replace(',', '', str_replace('Rp', '', $this->price_or_unit));
        $data->estimate_revenue         = str_replace(',', '', str_replace('Rp', '', $this->estimate_revenue));
        $data->duration                 = $this->duration($this->startdate, $this->enddate);
        $data->status                   = '';
        $data->brief_description        = $this->brief_description;
        $data->startdate                = $this->startdate;
        $data->enddate                  = $this->enddate;
        // $data->date                     = $this->date;
        $data->customer_type            = $this->customer_type;
        $data->sales_name               = $user->name;
        
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
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