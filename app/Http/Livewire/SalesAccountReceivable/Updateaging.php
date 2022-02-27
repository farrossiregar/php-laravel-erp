<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Updateaging extends Component
{
    protected $listeners = [
        'updateaging'=>'updateaging',
    ];

    use WithFileUploads;
    public $selected_id, $note;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.sales-account-receivable.updateaging');
    }

    public function updateaging($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
        
        $data->pic                      = $this->pic;
        $data->bank                     = $this->bank;
        $data->paid_amount_bank         = $this->paid_amount_bank;
        $data->save();

        session()->flash('message-success',"Berhasil, Aging berhasil diapprove!!!");
        
        return redirect()->route('sales-account-receivable.index');
    }
}
