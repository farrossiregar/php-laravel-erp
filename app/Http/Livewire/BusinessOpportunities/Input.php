<?php

namespace App\Http\Livewire\BusinessOpportunities;

use Livewire\Component;
use Auth;

class Input extends Component
{    
    public $customer, $project_name, $region, $qty, $price_or_unit, $estimate_revenue, $duration, $brief_description, $date, $customer_type, $customer_type2, $show_customer_type2=false;

    public function render()
    {
        return view('livewire.business-opportunities.input');        
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
        $data->region                   = $this->region;
        $data->qty                      = $this->qty;
        $data->price_or_unit            = $this->price_or_unit;
        $data->estimate_revenue         = $this->estimate_revenue;
        $data->duration                 = $this->duration;
        $data->status                   = '';
        $data->brief_description        = $this->brief_description;
        $data->date                     = $this->date;
        $data->customer_type            = $this->customer_type;
        $data->sales_name               = $user->name;
        
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();


        session()->flash('message-success',"Business Opportunity Berhasil diinput");
        
        return redirect()->route('business-opportunities.index');
    }
}