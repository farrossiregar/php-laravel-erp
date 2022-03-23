<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Summarynote extends Component
{

    protected $listeners = [
        'modalsummarynote'=>'summarynote',
    ];

    use WithFileUploads;
    public $file, $selected_id, $data, $summary_note;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.vendor-management.summarynote');
        
    }

    public function summarynote($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $this->summary_note = $data->summary_note;
    }
    
    public function save()
    {

     
        $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $data->summary_note         = $this->summary_note;
            
        $data->save();

        session()->flash('message-success',"Update Summary Note for Vendor Management success");
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('vendor-management.index');

    }
    
}
