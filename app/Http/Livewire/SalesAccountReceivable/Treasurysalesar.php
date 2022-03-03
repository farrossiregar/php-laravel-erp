<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Treasurysalesar extends Component
{
    protected $listeners = [
        'treasurysalesar'=>'treasurysalesar',
    ];

    use WithFileUploads;
    public $selected_id, $paid_amount_bank, $bank, $pic;    
    

    
    public function render()
    {
        return view('livewire.sales-account-receivable.treasurysalesar');
    }

    public function treasurysalesar($id)
    {
        $this->selected_id = $id;
        $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
        
        $this->paid_amount_bank         = $data->net_amount;
        $this->bank                     = $data->bank;
        $this->pic                      = $data->pic;
    }

  
    public function save()
    {
        
        $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
        
        $data->pic                      = $this->pic;
        $data->bank                     = $this->bank;
        $data->paid_amount_bank         = $this->paid_amount_bank;
        $data->save();

        session()->flash('message-success',"Berhasil, Treasury berhasil diapprove!!!");
        
        return redirect()->route('sales-account-receivable.index');
    }
}
