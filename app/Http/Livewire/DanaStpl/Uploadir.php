<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Uploadir extends Component
{

    protected $listeners = [
        'modaluploadir'=>'uploadir',
    ];

    use WithFileUploads;

    public $selected_id;
    public $file;

    
    public function render()
    {
        
        return view('livewire.dana-stpl.uploadir');
    }

    public function uploadir($id)
    {
        $this->selected_id = $id;
        
    }
  
    public function upload()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf,jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ir = 'dana-stpl-ir'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Dana_Stpl/insiden_report/',$ir);

            $data = \App\Models\DanaStpl::where('id', $this->selected_id)->first();            
            $data->uploadir = $ir;
            $data->save();
        }

      

        session()->flash('message-success',"Insiden Report Berhasil diupload");
        
        return redirect()->route('dana-stpl.index');
    }

   
}
