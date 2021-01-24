<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.work-flow-management.upload');
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
        
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data = new \App\Models\WorkFlowManagement();
                if($i[0]!="") $data->date = $i[0];
                $data->name = $i[1];
                $data->id_ = $i[2];
                $data->servicearea4 = $i[3];
                $data->city = $i[4];
                $data->servicearea2 = $i[5];
                $data->region = $i[6];
                $data->asp = $i[7];
                $data->region_dan_asp_info = $i[8];
                $data->skills = $i[9];
                $data->wo_assign = $i[10];
                $data->wo_accept = $i[11];
                $data->wo_close_manual = $i[12];
                $data->wo_close_auto = $i[13];
                $data->mttr = $i[14];
                $data->remark_wo_assign = $i[15];
                $data->remark_wo_accept = $i[16];
                $data->remark_wo_close_manual = $i[17];
                $data->final_remark = $i[18];
                $data->save();

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            return redirect()->route('work-flow-management.data');
        }
    }
}
