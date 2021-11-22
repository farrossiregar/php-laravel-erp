<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importdoc extends Component
{

    protected $listeners = [
        'modalimportdoc'=>'importdoc',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.commitment-letter.importdoc');
        
    }

    public function importdoc($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $check = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
            if($check->type_letter == '1'){
                $bcg = 'commitment-letter-bcg'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Commitment_Letter/BCG/',$bcg);

                $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
                $data->doc         = $bcg;
                
                $data->save();
            }elseif($check->type_letter == '2'){
                $cyber_security = 'commitment-letter-cybersecurity'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Commitment_Letter/Cyber_Security/',$cyber_security);
    
                $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
                $data->doc         = $cyber_security;
                
                $data->save();
            }else{
                $other = 'commitment-letter-other'.$check->type_letter.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Commitment_Letter/Other/',$other);
    
                $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
                $data->doc         = $other;
                
                $data->save();
            }
            
        }

        session()->flash('message-success',"Upload Commitment Letter success");
        
        
        return redirect()->route('commitment-letter.index');

    }
    
}
