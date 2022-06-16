<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonmsPo;

class Importaccdoc extends Component
{
    protected $listeners = [
        'modalimportaccdoc'=>'dataacceptance',
    ];

    use WithFileUploads;
    public $file,$file_invoice,$invoice_no,$invoice_date;
    public $data;
    public function render()
    {
        return view('livewire.po-tracking-nonms.importaccdoc');
    }

    public function dataacceptance(PoTrackingNonmsPo $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200',// 50MB maksimal
            'file_invoice'=>'required|mimes:xls,xlsx,pdf|max:51200', // 50MB maksimal
            'invoice_no' => 'required',
            'invoice_date' => 'required'
        ]);

        $accdoc = 'pononms-accdoc'.$this->data->id.'.'.$this->file->extension();
        $this->file->storePubliclyAs('public/po_tracking_nonms/acceptancedocs/',$accdoc);            
        $this->data->acceptance_file = "storage/po_tracking_nonms/acceptancedocs/{$accdoc}";

        $invoice = 'pononms-invoice'.$this->data->id.'.'.$this->file_invoice->extension();
        $this->file->storePubliclyAs('public/po_tracking_nonms/acceptancedocs/',$invoice);            
        $this->data->invoice_file = "storage/po_tracking_nonms/acceptancedocs/{$invoice}";
        $this->data->status = 5; // End
        $this->data->invoice_number = $this->invoice_no;
        $this->data->invoice_date = $this->invoice_date;
        $this->data->save();

        $this->emit('message-success',"Upload Acceptance Docs PO Tracking Non MS success");
        $this->emit('modal','hide');
    }
}
