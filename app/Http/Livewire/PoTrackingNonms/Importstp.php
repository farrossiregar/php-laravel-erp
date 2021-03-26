<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use \App\Models\PoTrackingNonms;

class Importstp extends Component
{
    protected $listeners = [
        'modal-stp'=>'datastp',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importstp');
    }

    public function datastp($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        $datamaster                 = new \App\Models\PoTrackingNonms();
        $datamaster->po_no          = '';
        $datamaster->region         = 'Region';
        $datamaster->site_id        = 'Site ID';
        $datamaster->site_name      = 'Site Name';
        $datamaster->no_tt          = 'No TT';
        $datamaster->status         = 'Status';
        $datamaster->pekerjaan      = 'Jenis Pekerjaan';
        $datamaster->created_at     = date('Y-m-d H:i:s');
        $datamaster->updated_at     = date('Y-m-d H:i:s');
        $datamaster->save();

        // if(count($sheetData) > 0){
        //     $countLimit = 1;
        //     $total_failed = 0;
        //     $total_success = 0;
        //     foreach($sheetData as $key => $i){
        //         if($key<1) continue; // skip header
                
        //         foreach($i as $k=>$a){ $i[$k] = trim($a); }
        //         $datapo = new \App\Models\PoTrackingReimbursement();
        //         if($i[0]!="") 
                
        //         $datapo->id_po_tracking_master                   = $datamaster->id;
        //         $datapo->po_reimbursement_id                     = $i[0];
        //         $datapo->change_history                          = $i[1];
        //         $datapo->rep_office                              = $i[2];
        //         $datapo->customer                                = $i[3];
        //         $datapo->project_name                            = $i[4];
        //         $datapo->project_code                            = $i[5];
        //         $datapo->site_id                                 = $i[6];
      
        //         $datapo->start_date                              = @date_format(date_create($i[22]), 'Y-m-d');
        //         $datapo->end_date                                = @date_format(date_create($i[22]), 'Y-m-d');
           
        //         $datapo->publish_date                            = @date_format(date_create($i[42]), 'Y-m-d H:i:s');
        //         $datapo->acceptance_date                         = @date_format(date_create($i[43]), 'Y-m-d');
     
        //         $datapo->created_at                              = date('Y-m-d H:i:s');
        //         $datapo->updated_at                              = date('Y-m-d H:i:s');
        //         $datapo->save();
                

        //         $total_success++;
        //     }
        // }
        // session()->flash('message-success',"Upload PO Tracking Non MS Document STP success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
        
        return redirect()->route('po-tracking-nonms.index');   
    }
}
