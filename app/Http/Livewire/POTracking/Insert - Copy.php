<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking.insert');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);


        $path = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        // $sheetData      = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();
        
        
        $potrackingpds                                                  = new \App\Models\PoTrackingPds();
        $potrackingpds->project_name                                    = $sheetData->getCell('Q4')->getValue();
        $potrackingpds->subcontract_no                                  = $sheetData->getCell('Q5')->getValue();
        $potrackingpds->employers_name                                  = $sheetData->getCell('Q6')->getValue();
        $potrackingpds->contract_no                                     = $sheetData->getCell('AZ4')->getValue();
        $potrackingpds->po_no                                           = $sheetData->getCell('AZ5')->getValue();
        $potrackingpds->subcontractors_name                             = $sheetData->getCell('AZ6')->getValue();
        
        $potrackingpds->project_quality_deduction_sum                   = $sheetData->getCell('Y9')->getValue();
        $potrackingpds->project_quality_deduction_note                  = $sheetData->getCell('AK9')->getValue();
        $potrackingpds->project_quality_deduction_description           = $sheetData->getCell('Y25')->getValue();

        $potrackingpds->good_deduction_sum                              = $sheetData->getCell('Y10')->getValue();
        $potrackingpds->good_deduction_note                             = $sheetData->getCell('AK10')->getValue();
        $potrackingpds->good_deduction_description                      = $sheetData->getCell('Y26')->getValue();

        $potrackingpds->delay_work_deduction_sum                        = $sheetData->getCell('Y11')->getValue();
        $potrackingpds->delay_work_deduction_note                       = $sheetData->getCell('AK11')->getValue();
        $potrackingpds->delay_work_deduction_description                = $sheetData->getCell('Y27')->getValue();

        $potrackingpds->dfpa_sum                                        = $sheetData->getCell('Y12')->getValue();
        $potrackingpds->dfpa_note                                       = $sheetData->getCell('AK12')->getValue();
        $potrackingpds->dfpa_description                                = $sheetData->getCell('Y27')->getValue();
        
        $potrackingpds->vat_sum                                         = $sheetData->getCell('Y13')->getValue();
        $potrackingpds->vat_note                                        = $sheetData->getCell('AK13')->getValue();
        
        $potrackingpds->created_at                                      = date('Y-m-d H:i:s');
        $potrackingpds->updated_at                                      = date('Y-m-d H:i:s');
        $potrackingpds->save();

        $params['text']     = 'Request Free Trial Absensi Digital';
        $emailto = ['farros.jackson@gmail.com'];
        $email = ['farrosashiddiq@gmail.com'];
        \Mail::send([], $params,
            // function($message) use($request, $file, $email, $emailto,$name_excel, $destination) {
            function($message) use($emailto, $email) {
                $message->from($email);
                $message->to($emailto);
                $message->subject('Request Trial');
                
            }
        );

        session()->flash('message-success',"Upload success");

        return redirect()->route('po-tracking.index');



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
