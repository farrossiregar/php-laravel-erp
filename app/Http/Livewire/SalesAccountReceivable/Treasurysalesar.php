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
    public $selected_id, $paid_amount_bank, $bank, $pic, $paid_amount, $bank_from, $pic_from, $difference;    
    

    
    public function render()
    {
        if(isset($this->paid_amount_bank)){
            $this->difference = $this->paid_amount - $this->paid_amount_bank;
        }

        return view('livewire.sales-account-receivable.treasurysalesar');
    }

    public function treasurysalesar($id)
    {
        $this->selected_id = $id;
        $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
        
        $this->paid_amount              = $data->net_amount;
        $this->bank                     = $data->bank;
        $this->pic                      = $data->pic;

        $this->paid_amount_bank         = $data->paid_amount_bank;
        $this->bank_from                = $data->bank_from;
        $this->pic_from                 = $data->pic_from;
        $this->difference               = $data->difference;
    }

  
    public function save()
    {
        
        $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
        
        if(strlen($this->selected_id) < 2){
            $ids = '00'.$this->selected_id;
        }elseif(strlen($this->selected_id) < 3){
            $ids = '0'.$this->selected_id;
        }else{
            $ids = $this->selected_id;
        }
        $data->cash_transaction_no      = $ids.'/'.date('d/M/Y').'CashIn';
        $data->pic_from                 = $this->pic_from;
        $data->bank_from                = $this->bank;
        $data->paid_amount_bank         = $this->paid_amount_bank;

        $data->pic                      = $this->pic;
        $data->bank                     = $this->bank;
        $data->paid_amount_bank         = $this->paid_amount_bank;

        $data->difference               = $this->difference;
        $data->save();

        session()->flash('message-success',"Berhasil, Treasury berhasil diapprove!!!");
        
        return redirect()->route('sales-account-receivable.index');
    }
}
