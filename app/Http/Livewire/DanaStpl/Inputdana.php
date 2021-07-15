<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Inputdana extends Component
{

    use WithFileUploads;
    public $project_name;
    public $projectcode;
    public $danastpl,$sm,$region;

    
    public function render()
    {
       
        return view('livewire.dana-stpl.inputdana');
    }

  
    public function save()
    {
        // dd($this->projectcode);
        $data = \App\Models\Project::select('projects.*', 'region_code as region_name', 'employees.name as sm_name', 'employees.id as smid')
                ->join('epl.region as region', 'region.id', 'projects.region_id')
                ->leftjoin('pmt.employees as employees', 'employees.id', 'projects.project_manager_id')
                ->where('projects.id', $this->projectcode)
                ->first();
        
        $datamaster                     = new \App\Models\DanaStpl();

        $datamaster->region_id          = $data->region_id;
        $datamaster->sm_id              = $data->project_manager_id;
        $datamaster->status             = null;
        $datamaster->company            = '';
        $datamaster->project_name       = $data->name;
        $datamaster->project_id         = $this->project_name;

        if($this->project_name == '1'){
            $datamaster->cmi = $this->danastpl;
        }

        if($this->project_name == '2'){
            $datamaster->h3i = $this->danastpl;
        }

        if($this->project_name == '3'){
            $datamaster->isat = $this->danastpl;
        }

        if($this->project_name == '4'){
            $datamaster->stp = $this->danastpl;
        }

        if($this->project_name == '5'){
            $datamaster->xl = $this->danastpl;
        }

        $datamaster->danastpl           = $this->danastpl;
        $datamaster->note_sm            = '';
        $datamaster->note_ms            = '';
        $datamaster->note_psm           = '';
        $datamaster->created_at         = date('Y-m-d H:i:s');
        $datamaster->updated_at         = date('Y-m-d H:i:s');
        $datamaster->save();

        $notifuser = \App\Models\Employee::where('id', $data->project_manager_id)->get();        
        
        foreach($notifuser as $no => $itemuser){
            $nameuser = $itemuser->name;
            $emailuser = $itemuser->email;
            $phoneuser = $itemuser->telepon;
            $message = "*Dear SM - ".$nameuser."*\n\n";
            $message .= "*Dana Stpl baru telah diajukan pada ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser,'message'=>$message]);   

            // \Mail::to($emailuser)->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Dana Berhasil diajukan");
        
        return redirect()->route('dana-stpl.index');
    }
}
