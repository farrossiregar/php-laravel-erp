<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importesar extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking.importesar');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);


        $path = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        $sheetDatas      = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();
        
        
        $potrackingesar                           = new \App\Models\PoTrackingEsar();
        $potrackingesar->po_no                    = $sheetData->getCell('E8')->getValue();
        $potrackingesar->payment                  = $sheetData->getCell('E9')->getValue();
        $potrackingesar->acceptance               = $sheetData->getCell('L6')->getValue();
        // $potrackingesar->save();

        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                if($key<12) continue; // skip header
                if($key>36) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $potrackingesar                           = new \App\Models\PoTrackingEsar();
                if($i[0]!="") 
                
                
                
                $potrackingesar->site_id                    = $i[3];
                $potrackingesar->site_name                  = $i[4];
                $potrackingesar->description                = $i[5];
                $potrackingesar->uom                        = $i[6];
                $potrackingesar->po_qty                     = $i[7];
                $potrackingesar->actual_qty                 = $i[8];
                $potrackingesar->start_date_on_po           = $i[11];
                $potrackingesar->end_date_on_po             = $i[12];
                $potrackingesar->remarks                    = $i[13];

                $potrackingesar->created_at                 = date('Y-m-d H:i:s');
                $potrackingesar->updated_at                 = date('Y-m-d H:i:s');
                $potrackingesar->save();

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('po-tracking.index');
        }
    }
}
