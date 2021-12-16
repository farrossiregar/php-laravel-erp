<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;

class Inputdutyroster extends Component
{
    use WithFileUploads;
    public $nama_dop, $project, $region, $alamat, $long, $lat, $pemilik_dop, $telepon_pemilik, $opex_region_ga, $type_homebase_dop, $expired, $budget;

    public function render()
    {
        return view('livewire.duty-roster-dophomebase.inputdutyroster');
    }

    public function save()
    {        
        $check = \App\Models\DophomebaseMaster::where('nama_dop', $this->nama_dop)->first();
        if($check){
            $data                       = \App\Models\DophomebaseMaster::where('nama_dop', $this->nama_dop)->first();
        }else{
            $data                       = new \App\Models\DophomebaseMaster();
        }

        $data->nama_dop                 = $this->nama_dop;
        $data->project                  = $this->project;
        $data->region                   = $this->region;
        $data->alamat                   = $this->alamat;
        $data->long                     = $this->long;
        $data->lat                      = $this->lat;
        $data->pemilik_dop              = $this->pemilik_dop;
        $data->telepon_pemilik          = $this->telepon_pemilik;
        $data->opex_region_ga           = $this->opex_region_ga;
        $data->type_homebase_dop        = $this->type_homebase_dop;
        $data->expired                  = $this->expired;
        $data->budget                   = $this->budget;
        $data->remarks                  = '';
        $data->employee_id = \Auth::user()->employee->id;
        $data->save();

        $notif = get_user_from_access('duty-roster.audit');
        foreach($notif as $user){
            if($user->email){
                $message = "<p>Dear {$user->name}<br />Duty Roster Site List need check Date Uploaded :<strong>".date('d-F-Y',strtotime($data->created_at))."</strong></p>";
                \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Duty Roster Site List",$message));
            }
        }

        session()->flash('message-success',"Input success, Success : <strong>Input Duty Roster DOP - Homebase Success!!!</strong>");
        
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