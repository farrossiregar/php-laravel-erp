<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuaweiItem;
use Livewire\WithFileUploads;

class FinanceAcceptance extends Component
{
    use WithFileUploads;
    public $data,$invoice_no,$invoice_date,$file,$file_invoice,$vat,$wht;
    protected $listeners = ['set_id'=>'set_id'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.finance-acceptance');
    }

    public function set_id(PoTrackingNonmsHuaweiItem $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->validate([
            'invoice_no'=>'required',
            'invoice_date'=>'required',
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200',// 50MB maksimal
            'file_invoice'=>'required|mimes:xls,xlsx,pdf|max:51200', // 50MB maksimal
        ]);

        $accdoc = 'pononms-huawei-accdoc'.$this->data->id.'.'.$this->file->extension();
        $this->file->storePubliclyAs('public/po_tracking_nonms/acceptancedocs/',$accdoc);            
        $this->data->acceptance_file = "storage/po_tracking_nonms/acceptancedocs/{$accdoc}";

        $invoice = 'pononms-huawei-invoice'.$this->data->id.'.'.$this->file_invoice->extension();
        $this->file->storePubliclyAs('public/po_tracking_nonms/acceptancedocs/',$invoice);            
        $this->data->invoice_file = "storage/po_tracking_nonms/acceptancedocs/{$invoice}";
        $this->data->status = 13; // End
        $this->data->invoice_no = $this->invoice_no;
        $this->data->invoice_date = $this->invoice_date;

        if($this->vat){
            $this->data->vat = $this->vat;
            $this->data->vat_amount = ($this->vat / 100) * $this->data->pr_amount;
            $this->data->total_price_after_vat = $this->data->vat_amount +  $this->data->pr_amount; 
        }

        if($this->wht){
            $this->data->wht = $this->wht;
            $this->data->wht_amount = ($this->wht / 100) * $this->data->pr_amount;
            $this->data->total_invoice = $this->data->total_price_after_vat - $this->data->wht_amount;
        }

        $this->data->save();

        $this->emit('message-success','Acceptance Doc & Invoice submitted');
        $this->emit('modal','hide');
        $this->emit('reload-page');
    }
}
