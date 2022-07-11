<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonmsPo;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBoq;

class Importaccdoc extends Component
{
    protected $listeners = [
        'modalimportaccdoc'=>'dataacceptance',
    ];

    use WithFileUploads;
    public $file,$file_invoice,$invoice_no,$invoice_date,$vat,$wht;
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

        if($this->vat){
            $this->data->vat = $this->vat;
            $this->data->vat_amount = ($this->vat / 100) * $this->data->payment_amount;
            $this->data->total_price_after_vat = $this->data->vat_amount +  $this->data->payment_amount; 
        }

        if($this->wht){
            $this->data->wht = $this->wht;
            $this->data->wht_amount = ($this->wht / 100) * $this->data->payment_amount;
            $this->data->total_invoice = $this->data->total_price_after_vat - $this->data->wht_amount;
        }

        $this->data->save();
        // $boq = $this->data->wos->first();
        // if($boq){
        //     $total = PoTrackingNonmsBoq::select(\DB::raw("SUM(input_price) as total_input_price"))->where('id_po_nonms_master',$boq->id_po_nonms_master)->first();
            
        //     if($total){
        //         $master = PoTrackingNonms::find($boq->id_po_nonms_master);
        //         if($this->vat){
        //             $master->vat = $this->vat;
        //             $master->vat_amount = ($this->vat / 100) * $total->total_input_price ;
        //             $master->total_price_after_vat = $master->vat_amount +  $total->total_input_price; 
        //         }
        
        //         if($this->wht){
        //             $master->wht = $this->wht;
        //             $master->wht_amount = ($this->wht / 100) * $total->total_input_price;
        //             $master->total_invoice = $master->total_price_after_vat - $master->wht_amount;
        //         }

        //         $master->save();
        //     }
        // }  

        $this->emit('message-success',"Upload Acceptance Docs PO Tracking Non MS success");
        $this->emit('modal','hide');
    }
}
