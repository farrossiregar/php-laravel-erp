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

        $path           = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        $sheetDatas     = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();


        $site_exp       = explode(" / ", substr($sheetData->getCell('F3')->getValue(), 2));

        $site_id        = $site_exp[0];
        $site_name      = $site_exp[1];

        $datamaster                 = new \App\Models\PoTrackingNonms();
        $datamaster->po_no          = '';
        $datamaster->region         = substr($sheetData->getCell('F5')->getValue(), 2);
        $datamaster->site_id        = $site_id;
        $datamaster->site_name      = $site_name;
        $datamaster->no_tt          = substr($sheetData->getCell('F6')->getValue(), 2);
        $datamaster->status         = 'Status';
        $datamaster->type_doc       = '1'; //STP
        $datamaster->pekerjaan      = substr($sheetData->getCell('F7')->getValue(), 2);
        $datamaster->created_at     = date('Y-m-d H:i:s');
        $datamaster->updated_at     = date('Y-m-d H:i:s');
        $datamaster->save();

        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                if($key<11) continue; // skip header
                if($key>12) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $potrackingstp                          = new \App\Models\PoTrackingNonmsStp();
                if($i[0]!="") 
                
                $potrackingstp->id_po_nonms_master         = $datamaster->id;
                $potrackingstp->material                   = $i[4];
                $potrackingstp->item_code                  = $i[8];
                $potrackingstp->qty                        = $i[9];
                $potrackingstp->unit                       = $i[10];
                $potrackingstp->price                      = $i[11];
                $potrackingstp->total_price                = $i[12];

                $potrackingstp->created_at                 = date('Y-m-d H:i:s');
                $potrackingstp->updated_at                 = date('Y-m-d H:i:s');
                $potrackingstp->save();

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('po-tracking-nonms.index');  
        }
         
    }
}
