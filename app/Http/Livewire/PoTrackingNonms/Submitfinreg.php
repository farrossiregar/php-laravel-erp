<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonmsBuktiTransfer;
use App\Models\PoTrackingNonms;

class Submitfinreg extends Component
{
    protected $listeners = [
        'modalsubmitfinreg'=>'datafinreg',
    ];

    use WithFileUploads;
    public $po_no;
    public $data;
    public $amount,$file;
    public function render()
    {
        return view('livewire.po-tracking-nonms.submitfinreg');
    }

    public function datafinreg($id)
    {
        $this->data = PoTrackingNonms::find($id);
        $this->amount = get_total_actual_price($this->data->id);
    }

    public function save()
    {
        $user = \Auth::user();

        $this->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'amount' => 'required'
        ]);
        
        $this->data->status = 5;
        $this->data->save();

        $name = date('ymdhis').PoTrackingNonmsBuktiTransfer::count() .".".$this->file->extension();
        $transfer = new PoTrackingNonmsBuktiTransfer();
        $this->file->storeAs("public/po-tracking-nonms/{$this->data->id}", $name);
        $transfer->file = "storage/po-tracking-nonms/{$this->data->id}/{$name}";
        $transfer->amount = $this->amount;
        $transfer->po_tracking_nonms_master_id = $this->data->id;
        $transfer->save();

        if($this->data->type_doc == '1'){
            $typedoc = 'STP';
        }else{
            $typedoc = 'Ericson';
        }

        $notif_user_finance_regional = check_access_data('po-tracking-nonms.notif-finance-regional', $this->data->region);

        $target_user = "Finance Regional";
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif_user_finance_regional as $no => $itemuserfinance){
            $nameuser[$no] = $itemuserfinance->name;
            $emailuser[$no] = $itemuserfinance->email;
            $phoneuser[$no] = $itemuserfinance->telepon;

            $message = "*Dear ".$target_user." - ".$nameuser[$no]."*\n\n";
            $message .= "*Budget Transfer untuk PO Tracking Non MS ".$typedoc." ".$this->data->no_tt." pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Success!, Budget for PO Tracking Non MS has been Succeed Transfered to ".$target_user." ".$this->data->region);
        
        return redirect()->route('po-tracking-nonms.index');
    }
}
