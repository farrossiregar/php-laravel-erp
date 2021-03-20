<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Approvebast extends Component
{
    protected $listeners = [
        'modal-approvebast'=>'dataapprovebast',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;
    public $status;

    public function render()
    {
        return view('livewire.po-tracking.approvebast');
    }

    public function dataapprovebast($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
        $status = $this->status;
        $user = \Auth::user();

        $data = \App\Models\PoTrackingReimbursementBastupload::where('po_no', $this->selected_id)->first();
        $data->bast_uploader_userid = $user->id;
        if($status == '1'){
            $status_text = 'Approved';
            $status_type = 'success';
            $data->status = $status;
        }else{
            $data->bast_filename = '';
            $status_text = 'Rejected';
            $status_type = 'danger';
            $data->status = $status;
        }

        $data->save();

        session()->flash('message-'.$status_type,"Success!, Bast PO No ".$this->selected_id." is ".$status_text);
        
        return redirect()->route('po-tracking.index');
    }
}
