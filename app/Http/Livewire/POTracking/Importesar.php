<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\PoTrackingReimbursementEsarupload;

class Importesar extends Component
{
    protected $listeners = [
        'modalesarupload'=>'dataesar',
        'refresh-upload-esar' => '$refresh'
    ];

    use WithFileUploads;
    
    public $file=[],$files=[],$title=[],$po,$esar_upload=[];

    public function render()
    {
        return view('livewire.po-tracking.importesar');
    }

    public function mount()
    {
        $this->files[] = 1;
    }
    
    public function add_files()
    {
        $this->files[] = count($this->files)+1;
    }

    public function delete_file($k)
    {
        unset($this->files[$k]);
    }

    public function dataesar(PoTrackingReimbursement $po)
    {
        $this->po = $po;
        $this->esar_upload = PoTrackingReimbursementEsarupload::where(['po_tracking_reimbursement_id'=>$this->po->id])->get();
        $this->emit('refresh-upload-esar');
    }

    public function save()
    {
        $this->validate([
            'file.*'=>'required|mimes:pdf,msg,xls,xlsx|max:51200' // 50MB maksimal
        ]);
        foreach($this->files as $k => $item){
            if($this->file[$k]){
                $esar = 'Approved-Esar-'.$this->po->po_reimbursement_id.PoTrackingReimbursementEsarupload::count().'.'.$this->file[$k]->extension();
                $this->file[$k]->storePubliclyAs('public/po_tracking/ApprovedEsar/',$esar);
    
                $data = new PoTrackingReimbursementEsarupload();
                $data->po_no = $this->po->po_reimbursement_id;
                $data->title = $this->title[$k];
                $data->po_tracking_reimbursement_id = $this->po->id;
                $data->approved_esar_filename           = $esar;
                $data->approved_esar_uploader_userid    = '18';
                $data->approved_esar_date               = date('Y-m-d H:i:s');
                $data->save();
            }
        }
        
        $this->po->status = 3; // upload approved 
        $this->po->save();

        session()->flash('message-success',"Upload Approved ESAR success");

        return redirect()->route('po-tracking.index');
    }
}