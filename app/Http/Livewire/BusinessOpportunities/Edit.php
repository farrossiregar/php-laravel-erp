<?php

namespace App\Http\Livewire\BusinessOpportunities;

use Livewire\Component;
use Auth;

class Edit extends Component
{    
    protected $listeners = [
        'modaleditbo'=>'edit',
    ];

    public $customer, $selected_id, $project_name, $quotation_number, $po_number, $region, $qty, $unit, $price_or_unit, $estimate_revenue, $duration, $brief_description, $startdate, $enddate, $date, $customer_type, $customer_type2, $show_customer_type2=false;

    public function render()
    {
        return view('livewire.business-opportunities.edit');        
    }

    public function edit($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\BusinessOpportunities::where('id', $this->selected_id)->first();
        
        $this->customer                 = $this->data->customer;
        $this->project_name             = $this->data->project_name;
        $this->quotation_number         = $this->data->quotation_number;
        $this->po_number                = $this->data->po_number;
        $this->region                   = $this->data->region;
        $this->qty                      = $this->data->qty;
        $this->unit                     = $this->data->unit;
        $this->price_or_unit            = $this->data->price_or_unit;
        $this->estimate_revenue         = $this->data->estimate_revenue;
        $this->duration                 = $this->data->duration;
        $this->brief_description        = $this->data->brief_description;
        $this->startdate                = $this->data->startdate;
        $this->enddate                  = $this->data->enddate;
        $this->customer_type            = $this->data->customer_type;
        
    }
  
    public function save()
    {
        $user = \Auth::user();
       
        $data                           = \App\Models\BusinessOpportunities::where('id', $this->selected_id)->first();
        $data->customer                 = $this->customer;
        $data->project_name             = $this->project_name;
        $data->quotation_number         = $this->quotation_number;
        $data->po_number                = $this->po_number;
        $data->region                   = $this->region;
        $data->qty                      = $this->qty;
        $data->unit                      = $this->unit;
        $data->price_or_unit            = $this->price_or_unit;
        $data->estimate_revenue         = $this->estimate_revenue;
        $data->duration                 = $this->duration($this->startdate, $this->enddate);
        $data->status                   = '';
        $data->brief_description        = $this->brief_description;
        $data->startdate                = $this->startdate;
        $data->enddate                  = $this->enddate;
        
        $data->customer_type            = $this->customer_type;
        if($data->status == '0'){
            $data->status            = '';
        }
        
        $data->sales_name               = $user->name;
        
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"Business Opportunity Berhasil diinput");
        
        return redirect()->route('business-opportunities.index');
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