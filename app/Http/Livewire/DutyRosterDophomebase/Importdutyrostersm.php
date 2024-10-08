<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importdutyrostersm extends Component
{

    use WithFileUploads;
    public $file;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.duty-roster-dophomebase.importdutyrostersm');
        
    }

  
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

       

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;

            $datamaster                 = new \App\Models\DutyrosterDophomebaseMaster();
            $datamaster->upload_by      = 'SM';
            $datamaster->created_at     = date('Y-m-d H:i:s');
            $datamaster->updated_at     = date('Y-m-d H:i:s');
            $datamaster->status         = '1';
           

            // if(check_access('duty-roster-dophomebase.importsm')){
            //     $datamaster->status     = '1';     
            // }
            $datamaster->save();


            foreach($sheetData as $key => $i){
                if($key<2) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                    
                $datadutyroster                           = new \App\Models\DutyrosterDophomebaseDetail();
                $datadutyroster->id_master_dutyroster     = $datamaster->id;
                $datadutyroster->nama_dop                 = $i[0];
                $datadutyroster->project                  = $i[1];
                $datadutyroster->region                   = $i[2];
                $datadutyroster->alamat                   = $i[3];
                $datadutyroster->long                     = $i[4];
                $datadutyroster->lat                      = $i[5];
                $datadutyroster->pemilik_dop              = $i[6];
                $datadutyroster->telepon_pemilik          = $i[7];
                $datadutyroster->opex_region_ga           = $i[8];
                $datadutyroster->type_homebase_dop        = $i[9];
                $datadutyroster->expired                  = $i[10];
                $datadutyroster->budget                   = $i[11];
                $datadutyroster->remarks                  = '';
                $datadutyroster->created_at               = date('Y-m-d H:i:s');
                $datadutyroster->updated_at               = date('Y-m-d H:i:s');
                $datadutyroster->save();

                $check = \App\Models\DophomebaseMaster::where('nama_dop', $i[0])->first();
                if($check){
                    $data               = \App\Models\DophomebaseMaster::where('nama_dop', $i[0])->first();
                }else{
                    $data               = new \App\Models\DophomebaseMaster();
                }
                
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
                $data->expired                  = $i[10].' 00:00:00';
                $data->budget                   = $i[11];
                $data->remarks                  = '';
                $data->save();
                
                $total_success++;
            }

            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('duty-roster-dophomebase.index');   
        }
    }
    

    public function yearborn($year){
        if($year > substr(date('Y'), 2, 2)){
            return '19'.$year;
        }else{
            return '20'.$year;
        }

    }
}
