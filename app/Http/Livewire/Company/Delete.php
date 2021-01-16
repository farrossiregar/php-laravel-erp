<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use App\Helpers\GeneralHelper;

class Delete extends Component
{
    public $data;
    public $region_id;
    public $name;
    public $message;

    public function render()
    {
        $delete = Company::find($this->id);

        $delete->delete(); 
        session()->flash('message-error','Delete Success.'); 
        return redirect()->to('company');
        
    }

    public function mount($id)
    {
        $this->data         = Company::find($id);
        
        $this->id         = $this->data->id;
    }

}
