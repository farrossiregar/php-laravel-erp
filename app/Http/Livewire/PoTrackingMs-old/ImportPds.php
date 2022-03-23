<?php

namespace App\Http\Livewire\POTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class ImportPds extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.potracking.insert');
    }
    public function save()
    {
        $potrackingpds = new \App\Models\PoTrackingPds();
        $potrackingpds->project_name                           = $sheetData->getCell('Q4');
        $potrackingpds->created_at                             = date('Y-m-d H:i:s');
        $potrackingpds->updated_at                             = date('Y-m-d H:i:s');
        $potrackingpds->save();
        // $this->validate([
        //     'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        // ]);


        // $path = $this->file->getRealPath();
       
        // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $data = $reader->load($path);
        // $sheetData = $data->getActiveSheet()->toArray();
        // // $sheetData = $data->getActiveSheet();
        
        // $potrackingpds = new \App\Models\PoTrackingPds();
        // $potrackingpds->project_name                           = $sheetData->getCell('Q4');
        // $potrackingpds->created_at                             = date('Y-m-d H:i:s');
        // $potrackingpds->updated_at                             = date('Y-m-d H:i:s');
        // $potrackingpds->save();

        session()->flash('message-success',"Upload success");
            
        // return redirect()->route('po-tracking.index');
        // dd('save');


        // if(count($sheetData) > 0){
        //     $countLimit = 1;
        //     $total_failed = 0;
        //     $total_success = 0;


  

        //     // foreach($sheetData as $key => $i){
        //     //     if($key<1) continue; // skip header
                
        //     //     foreach($i as $k=>$a){ $i[$k] = trim($a); }
        //     //     $criticalcase = new \App\Models\PoTrackingPds();
        //     //     if($i[0]!="") 
                

        //     //     $criticalcase->pic                                    = $i[1];
        //     //     $criticalcase->date                                   = @date_format(date_create($i[3]), 'Y-m-d');

        //     //     $criticalcase->created_at                             = date('Y-m-d H:i:s');
        //     //     $criticalcase->updated_at                             = date('Y-m-d H:i:s');
        //     //     $criticalcase->save();

        //     //     $total_success++;
        //     // }
        //     session()->flash('message-success',"Upload success");
            
        //     return redirect()->route('po-tracking.index');
        // }
    }
}
