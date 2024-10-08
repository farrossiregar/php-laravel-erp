<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importpds extends Component
{

    protected $listeners = [
        'modaluploadpds'=>'uploadpds',
    ];

    use WithFileUploads;
    // public $employee_id, $employee_name, $departement, $lokasi, $type_request, $request_room_detail;
    // public $purpose, $participant, $start_date_booking, $start_time_booking, $end_date_booking, $end_time_booking;
    public $file, $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    
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
        
        
        return view('livewire.po-tracking-ms.importpds');
        
    }

    public function uploadpds($id)
    {
        $this->selected_id = $id;
    }
  
    public function save()
    {
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $pds = 'poms-pds'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking_ms/Pds/',$pds);

            $data = \App\Models\PoTrackingMs::where('id', $this->selected_id)->first();
            
            $data->pds         = $pds;
            
            $data->save();
        }

        session()->flash('message-success',"Upload PDS for Record, Tracking and Monitoring PO to Payment For MS PO success");
        
        return redirect()->route('po-tracking-ms.index',['id'=>$data->id]);

    }


    
}
