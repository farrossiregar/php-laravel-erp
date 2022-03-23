<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;

class Importdutyroster extends Component
{

    use WithFileUploads;
    public $file;

    
    public function render()
    {
        return view('livewire.duty-roster.importdutyroster');   
    }

  
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
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

            $datamaster                 = new \App\Models\DutyrosterSitelistMaster();
            $datamaster->employee_id = \Auth::user()->employee->id;
            $datamaster->client_project_id = session()->get('project_id');
            $datamaster->status = 1;
            $datamaster->save();

            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                    
                $data                           = new \App\Models\DutyrosterSitelistDetail();

                $data->id_master_dutyroster     = $datamaster->id;
                $data->project                  = $i[0];
                $data->tower_index              = $i[1];
                $data->site_id                  = $i[2];
                $data->site_name                = $i[3];
                $data->ne_system                = $i[4];
                $data->site_address             = $i[5];
                $data->cluster                  = $i[6];
                $data->sub_cluster              = $i[7];
                $data->region                   = $i[8];
                $data->sub_region               = $i[9];
                $data->idpel_pln                = $i[10];

                $data->lat                      = $i[11];
                $data->long                     = $i[12];
                $data->category_site            = $i[13];
                $data->depedency                = $i[14];
                $data->pm_category              = $i[15];
                $data->macro_ibc_mcp_repeater   = $i[16];
                $data->site_type                = $i[17];
                $data->permanent_genset         = $i[18];
                $data->tower_owner              = $i[19];
                
                $data->sm                       = $i[21];
                $data->sm_no1                   = $i[22];
                $data->sm_no2                   = $i[23];
                $data->coordinator              = $i[24];
                $data->coordinator_no1          = $i[25];
                $data->coordinator_no2          = $i[26];
                $data->te                       = $i[27];
                $data->te_no1                   = $i[28];
                $data->te_no2                   = $i[29];
                $data->cme                      = $i[30];

                $data->cme_no1                  = $i[31];
                $data->cme_no2                  = $i[32];
                $data->collo_type               = $i[33];
                $data->rectifikasi1             = $i[34];
                $data->rectifikasi1_no1         = $i[35];
                $data->rectifikasi1_no2         = $i[36];
                $data->rectifikasi2             = $i[37];
                $data->rectifikasi2_no1         = $i[38];
                $data->rectifikasi2_no2         = $i[39];
                $data->rainy_session1           = $i[40];

                $data->rainy_session1_no1       = $i[41];
                $data->rainy_session1_no2       = $i[42];
                $data->rainy_session2           = $i[43];
                $data->rainy_session2_no1       = $i[44];
                $data->rainy_session2_no2       = $i[45];
                $data->digger                   = $i[46];
                $data->digger_no1               = $i[47];
                $data->digger_no2               = $i[48];
                $data->waspan                   = $i[49];
                $data->waspan_no1               = $i[50];

                $data->waspan_no2               = $i[51];
                $data->vehicle                  = $i[52];
                $data->splicer                  = $i[53];
                $data->otdr                     = $i[54];
                $data->opm                      = $i[55];
                $data->fo_cable_single72        = $i[56];
                $data->fo_cable_single36        = $i[57];
                $data->cable_fig8               = $i[58];
                $data->cable_72ribbon           = $i[59];
                $data->closure                  = $i[60];
                $data->hdpe                     = $i[61];
                $data->protection_sleeve        = $i[62];
                $data->bamboo                   = $i[63];
                $data->po_in_out                = $i[64];
                $data->entity                   = $i[65];
                $data->project_code             = $i[66];
                $data->remarks                  = '';
                $data->save();
                    
                $total_success++;
            }

            // send notif to admin project
            $notif = get_user_from_access('duty-roster.approve',session()->get('project_id'));
            foreach($notif as $user){
                if($user->email){
                    $message = "<p>Dear {$user->name}<br />Duty Roster Site List need your approval Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
                    \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
                }
            }
            
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('duty-roster.index');   
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
