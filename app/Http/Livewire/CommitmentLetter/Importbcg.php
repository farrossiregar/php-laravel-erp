<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importbcg extends Component
{

    protected $listeners = [
        'modalimportbcg'=>'importbcg',
    ];

    use WithFileUploads;
    public $file, $selected_id;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.commitment-letter.importbcg');
        
    }

    public function importbcg($id)
    {
        $this->selected_id = $id;
    }
    
    public function save()
    {

        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $bcg = 'commitment-letter-bcg'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Commitment_Letter/BCG/',$bcg);

            $data = \App\Models\CommitmentLetter::where('id', $this->selected_id)->first();
            $data->bcg         = $bcg;
            
            $data->save();
        }

        session()->flash('message-success',"Upload BCG for Commitment Letter success");
        
        
        return redirect()->route('commitment-letter.index');

    }
    
}
