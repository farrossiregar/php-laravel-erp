<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class Importdutyroster extends Component
{
    use WithFileUploads;
    public $file;

    public function render()
    {
        return view('livewire.duty-roster-dophomebase.importdutyroster');   
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);

        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            $notif = get_user_from_access('duty-roster-dophomebase.approval');
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                
                $data = new \App\Models\DophomebaseMaster();
                $data->nama_dop                 = $i[0];
                $data->project                  = $i[1];
                $data->region                   = $i[2];
                $data->alamat                   = $i[3];
                $data->long                     = $i[4];
                $data->lat                      = $i[5];
                $data->pemilik_dop              = $i[6];
                $data->telepon_pemilik          = $i[7];
                $data->opex_region_ga           = $i[8];
                $data->type_homebase_dop        = $i[9];
                $data->expired                  = $i[10];
                $data->budget                   = $i[11];
                $data->remarks                  = '';
                $data->employee_id = \Auth::user()->employee->id;
                $data->save();
                $total_success++;

                foreach($notif as $user){
                    if($user->email){
                        $message  = "<p>Dear {$user->name}<br />Duty Roster Home Base need your approval </p>";
                        $message .= "<p>Nama DOP: {$data->nama_dop}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
                        
                        \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
                    }
                }
            }
        }

        \LogActivity::add('[web] Duty Roster - Home Base Import');

        session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
        return redirect()->route('duty-roster-dophomebase.index');   
    }

    public function yearborn($year){
        if($year > substr(date('Y'), 2, 2)){
            return '19'.$year;
        }else{
            return '20'.$year;
        }

    }
}
