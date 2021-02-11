<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.criticalcase.insert');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();

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
                $criticalcase = new \App\Models\Criticalcase();
                if($i[0]!="") 
                
                if($i[14] == 'Closed'){ 
                    $stat = '0'; 
                }else{ 
                    $stat = '1'; 
                }
                $criticalcase->pic                                    = $i[1];
                $criticalcase->shift_number                           = $i[2];
                $criticalcase->date                                   = @date_format(date_create($i[3]), 'Y-m-d');
                $criticalcase->activity_handling                      = $i[4];
                $criticalcase->time_occur                             = @date_format(date_create(str_replace(",", "",$i[5])), 'Y-m-d H:i:s');
                $criticalcase->severity                               = $i[6];
                $criticalcase->project                                = $i[7];
                $criticalcase->region                                 = $i[8];
                $criticalcase->category                               = $i[9];
                $criticalcase->impact                                 = $i[10];
                $criticalcase->action                                 = $i[11];
                $criticalcase->customer_handling                      = $i[12];
                $criticalcase->time_closed                            = @date_format(date_create($i[13]), 'Y-m-d H:i:s');
                $criticalcase->status                                 = $stat;
                $criticalcase->last_update                            = $i[15];
                $criticalcase->created_at                             = date('Y-m-d H:i:s');
                $criticalcase->updated_at                             = date('Y-m-d H:i:s');
                $criticalcase->save();

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('critical-case.index');
        }
    }
}
