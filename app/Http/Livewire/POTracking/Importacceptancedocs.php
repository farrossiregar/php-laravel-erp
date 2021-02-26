<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importacceptancedocs extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking.importacceptancedocs');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        session()->flash('message-success',"Upload success");
            
        return redirect()->route('po-tracking.index');
    }
}
