<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Improvementpoint extends Component
{

    protected $listeners = [
        'modalimprovementpoint'=>'improvementpoint',
    ];

    use WithFileUploads;
    public $file, $selected_id, $improvement_point;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.vendor-management.improvementpoint');
        
    }

    public function improvementpoint($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $this->improvement_point = $data->improvement_point;
    }
    
    public function save()
    {

      
     
        $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $data->improvement_point         = $this->improvement_point;
            
        $data->save();

        session()->flash('message-success',"Update Improvement Point for Vendor Management success");
        
        
        // return redirect()->route('contract-registration-flow.index');
        return redirect()->route('vendor-management.index');

    }
    
}
