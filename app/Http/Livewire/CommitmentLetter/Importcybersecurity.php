<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importcybersecurity extends Component
{

    protected $listeners = [
        'modalimportcybersecurity'=>'importcybersecurity',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.commitment-letter.importcybersecurity');
        
    }

    public function importcybersecurity($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $cyber_security = 'commitment-letter-cybersecurity'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Commitment_Letter/Cyber_Security/',$cyber_security);

            $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
            $data->cyber_security         = $cyber_security;
            
            $data->save();
        }

        session()->flash('message-success',"Upload Cyber Security for Commitment Letter success");
        
        
        return redirect()->route('commitment-letter.index');

    }
    
}
