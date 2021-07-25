<?php

namespace App\Http\Livewire\DatabaseNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importnoc extends Component
{

    use WithFileUploads;
    public $file;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.database-noc.importnoc');
        
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
            $total_resign = 0;

            $checkmaster                 = \App\Models\EmployeeNoc::where('month', date('m'))->where('year', date('Y'))->first();
            if(!$checkmaster){
                $datamaster                 = new \App\Models\EmployeeNoc();
                $datamaster->month          = date('m');
                $datamaster->year           = date('Y');
                $datamaster->created_at     = date('Y-m-d H:i:s');
                $datamaster->updated_at     = date('Y-m-d H:i:s');
                $datamaster->save();
            }else{
                $datamaster                 = \App\Models\EmployeeNoc::where('month', date('m'))->where('year', date('Y'))->first();
                $datamaster->month          = date('m');
                $datamaster->year           = date('Y');
                $datamaster->created_at     = date('Y-m-d H:i:s');
                $datamaster->updated_at     = date('Y-m-d H:i:s');
                $datamaster->save();
            }


            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                    
                $check = \App\Models\Employee::where('nik', $i[0])->first();
                if($check){
                    $data = \App\Models\Employee::where('nik', $i[0])->first();
                    $data->name                 = $i[1];
                    $data->place_of_birth       = $i[22];
                    $data->date_of_birth        = date('Y-m-d', strtotime($i[23]));
                    $data->marital_status       = $i[25];
                    // $data->blood_type           = $i[0];
                    $data->email                = 'farrosashiddiq@gmail.com';//$i[28];
                    $data->join_date            = date('Y-m-d', strtotime($i[11]));
                    $data->resign_date          = @date('Y-m-d', strtotime($i[13]));
                    // $data->employee_status      = $i[0];
                    $data->telepon              = $i[6];
                    $data->telepon2             = $i[7];
                    $data->telepon3             = $i[8];
                    $data->npwp_number          = $i[33];
                    $data->bpjs_number          = $i[32];
                    $data->bpjs_pensiun         = $i[31];
                    $data->bpjs_jht             = $i[30];
                    
                    $data->religion             = $i[29];
                    $data->address              = $i[19];
                    $data->domisili             = $i[20];
                    $data->postcode             = $i[21];
                    // $data->foto              = $i[0];
                    // $data->user_id              = $i[0];
                    // $data->department_id        = $i[0];
                    // $data->department_sub_id    = $i[0];
                    $data->user_access_id       = $i[2];
                    // $data->foto_ktp          = $i[0];
                    $data->region_id            = $i[3];
                    // $data->company_id        = $i[0];
                    // $data->lokasi_kantor     = $i[0];
                    $data->cluster              = $i[4];
                    $data->project              = $i[5];
                    $data->emergency_contact    = $i[9];
                    $data->emergency_number     = $i[10];
                    $data->contract_end         = $i[12];
                    $data->resignation_reason   = $i[14];
                    $data->account_name         = $i[15];
                    $data->bank_name            = $i[16];
                    $data->account_number       = $i[17];
                    $data->tax_status           = $i[26];
                    $data->mothers_name         = $i[27];
                    $data->education_level      = $i[34];
                    $data->updated_at           = date('Y-m-d H:i:s');
                    $data->save();

                    if($i[13] != ''){
                        $total_resign++;
                    }
                }else{
                    $data = new \App\Models\Employee();
                    $data->nik                  = $i[0];
                    $data->name                 = $i[1];
                    $data->place_of_birth       = $i[22];
                    $data->date_of_birth        = date('Y-m-d', strtotime($i[23]));
                    $data->marital_status       = $i[25];
                    // $data->blood_type           = $i[0];
                    $data->email                = 'farrosashiddiq@gmail.com';//$i[28];
                    $data->join_date            = date('Y-m-d', strtotime($i[11]));
                    $data->resign_date          = @date('Y-m-d', strtotime($i[13]));
                    // $data->employee_status      = $i[0];
                    $data->telepon              = $i[6];
                    $data->telepon2             = $i[7];
                    $data->telepon3             = $i[8];
                    $data->npwp_number          = $i[33];
                    $data->bpjs_number          = $i[32];
                    $data->bpjs_pensiun         = $i[31];
                    $data->bpjs_jht             = $i[30];
                    
                    $data->religion             = $i[29];
                    $data->address              = $i[19];
                    $data->domisili             = $i[20];
                    $data->postcode             = $i[21];
                    // $data->foto              = $i[0];
                    // $data->user_id              = $i[0];
                    // $data->department_id        = $i[0];
                    // $data->department_sub_id    = $i[0];
                    $data->user_access_id       = $i[2];
                    // $data->foto_ktp          = $i[0];
                    $data->region_id            = $i[3];
                    // $data->company_id        = $i[0];
                    // $data->lokasi_kantor     = $i[0];
                    $data->cluster              = $i[4];
                    $data->project              = $i[5];
                    $data->emergency_contact    = $i[9];
                    $data->emergency_number     = $i[10];
                    $data->contract_end         = $i[12];
                    $data->resignation_reason   = $i[13];
                    $data->account_name         = $i[15];
                    $data->bank_name            = $i[16];
                    $data->account_number       = $i[17];
                    $data->tax_status           = $i[26];
                    $data->mothers_name         = $i[27];
                    $data->education_level      = $i[34];
                    $data->created_at           = date('Y-m-d H:i:s');
                    $data->updated_at           = date('Y-m-d H:i:s');
                    $data->save();

                    if($i[13] != ''){
                        $total_resign++;
                    }
                }
                    
               

                $total_success++;
            }

            
            $datamasterupdate                 = \App\Models\EmployeeNoc::where('id', $datamaster->id)->first();
            $datamasterupdate->jumlah_active  = $total_success - $total_resign;
            $datamasterupdate->jumlah_resign  = $total_resign;
            $datamasterupdate->save();
        
            

            // dd($total_success - $total_resign);
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('database-noc.index');   
        }
    }
}
