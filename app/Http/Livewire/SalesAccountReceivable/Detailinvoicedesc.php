<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Detailinvoicedesc extends Component
{
    protected $listeners = [
        'detailinvoicedesc'=>'detailinvoicedesc',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $art23, $art4, $deduction, $net_amount, $vat, $total;

    
    public function render()
    {
        return view('livewire.sales-account-receivable.detailinvoicedesc');
    }

    public function detailinvoicedesc($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\SalesInvoiceListingDetails::where('id', $id)->first();
        $this->art23        = $data->art23;
        $this->art4         = $data->art4;
        $this->deduction    = $data->deduction;
        $this->net_amount   = $data->net_amount;
        $this->total        = $data->total;
        $this->vat          = $data->vat;
    }

  
   
}
