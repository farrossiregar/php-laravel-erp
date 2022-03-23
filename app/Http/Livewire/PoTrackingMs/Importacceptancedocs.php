<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importacceptancedocs extends Component
{
    protected $listeners = [
        'modaluploadaccdocs'=>'uploadacceptancedocs',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        $user = \Auth::user();
        $this->employee_id = $user->id;
        $this->employee_name = $user->name;
        $this->departement = get_position($user->user_access_id);
        // dd($user);
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.po-tracking-ms.importacceptancedocs');
        
    }

    public function uploadacceptancedocs($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $accdocs = 'poms-accdocs'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_ms/Acceptance_docs/',$accdocs);

            $data = \App\Models\PoTrackingMs::where('id', $this->selected_id)->first();
            $data->acceptance_docs         = $accdocs;

            if($data->invoice != ''){
                $data->status  = '6';
            }
            
            $data->save();
        }

        session()->flash('message-success',"Upload Acceptance Docs for Record, Tracking and Monitoring PO to Payment For MS PO success");
        
        return redirect()->route('po-tracking-ms.index',['id'=>$data->id]);

    }


    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        if($hours > 0){
            $waktu = $hours.'.'.$minuts.' hours';
            // $waktu = $hours;
        }else{
            $waktu = $minuts.' minute';
            // $waktu = $minuts;
        }
        return $waktu;
    }
    
}
