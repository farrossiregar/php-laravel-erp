<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PoMsEricsson;

class Ericsson extends Component
{
    use WithFileUploads;
    public $file,$is_e2e,$is_service_manager,$is_have_deduction=0,$selected;
    public $approval_file,$pds_file,$pds_amount,$file_verification,$acceptance_doc,$invoice_doc;
    public $is_finance;
    protected $rules = [
        'file' => 'required',
    ];

    public function render()
    {
        $data = PoMsEricsson::orderBy('created_at', 'desc');
                                
        return view('livewire.po-tracking-ms.ericsson')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $this->is_e2e = check_access('is-e2e');
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_finance = check_access('is-finance');
    }

    public function set_selected(PoMsEricsson $selected)
    {
        $this->selected = $selected;
    }

    public function update_progress(PoMsEricsson $selected, $field,$value)
    {
        $selected->$field = $value;
        $selected->save();

        $this->emit('message-success',"PO Number {$selected->po_no} updated.");
        $this->emit('modal','hide');
    }

    public function updated($propertyName)
    {

    }

    public function submit_verification()
    {
        $this->validate([
            'file_verification'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:51200', // 50MB maksimal
        ]);

        if($this->file_verification){
            $doc = 'verification-docs.'.$this->file_verification->extension();
            $this->file_verification->storePubliclyAs("public/po_tracking_ms/{$this->selected->id}",$doc);
            $this->selected->file_verification ="storage/po_tracking_ms/{$this->selected->id}/{$doc}";
        }

        $this->selected->status_ = 4;
        $this->selected->save();

        $this->emit('message-success',"PO Number {$this->selected->po_no} submitted.");
        $this->emit('modal','hide');
    }

    public function submit_acceptance()
    {
        $this->validate([
            'acceptance_doc'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:51200', // 50MB maksimal
            // 'invoice_doc'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:51200', // 50MB maksimal
        ]);

        if($this->acceptance_doc){
            $doc = 'acceptance-docs.'.$this->acceptance_doc->extension();
            $this->acceptance_doc->storePubliclyAs("public/po_tracking_ms/{$this->selected->id}",$doc);
            $this->selected->acceptance_doc ="storage/po_tracking_ms/{$this->selected->id}/{$doc}";
        }
        // if($this->invoice_doc){
        //     $doc = 'invoice-docs.'.$this->invoice_doc->extension();
        //     $this->invoice_doc->storePubliclyAs("public/po_tracking_ms/{$this->selected->id}",$doc);
        //     $this->selected->invoice_doc ="storage/po_tracking_ms/{$this->selected->id}/{$doc}";
        // }

        $this->selected->status_ = 5;
        $this->selected->save();

        $this->emit('message-success',"PO Number {$this->selected->po_no} submitted.");
        $this->emit('modal','hide');
    }

    public function submit_pds()
    {
        $this->validate([
            'pds_file'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:51200', // 50MB maksimal
            'pds_amount'=>'required'
        ]);

        if($this->pds_file){
            $doc = 'pds-docs.'.$this->pds_file->extension();
            $this->pds_file->storePubliclyAs("public/po_tracking_ms/{$this->selected->id}",$doc);
            $this->selected->pds_file ="storage/po_tracking_ms/{$this->selected->id}/{$doc}";
        }

        $this->selected->pds_amount = $this->pds_amount;
        $this->selected->status_ = 1;
        $this->selected->save();

        $this->emit('message-success',"PO Number {$this->selected->po_no} submitted.");
        $this->emit('modal','hide');
    }

    public function process_regional()
    {
        if($this->is_have_deduction==0){
            $this->validate([
                'approval_file'=>'required|mimes:pdf,doc,docx,xls,xlsx|max:51200' // 50MB maksimal
            ]);
        }

        if($this->approval_file and $this->is_have_deduction==0){
            $doc = 'approval-docs.'.$this->approval_file->extension();
            $this->approval_file->storePubliclyAs("public/po_tracking_ms/{$this->selected->id}",$doc);
            $this->selected->approval_file ="storage/po_tracking_ms/{$this->selected->id}/{$doc}";
            $this->selected->save();
        }
        /**
         * Deduction E2E upload pds
         * Upload Verification docs
         */
        if($this->selected->is_have_deduction!=1) $this->selected->is_have_deduction = $this->is_have_deduction;
        $this->selected->status_ = $this->is_have_deduction==1? 3 : 2;
        $this->selected->save();

        session()->flash('message-success',"PO Submitted");
            
        return redirect()->route('po-tracking-ms.index');  
         
    }
}
