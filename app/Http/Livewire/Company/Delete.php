<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use App\Helpers\GeneralHelper;

class Delete extends Component
{
    // public $data;
    // public $region_id;
    // public $name;
    // public $message;

    // public function render()
    // {
    //     $delete = Company::find($this->id);

    //     $delete->delete(); 
    //     session()->flash('message-error','Delete Success.'); 
    //     return redirect()->to('company');
        
    // }

    // public function mount($id)
    // {
    //     $this->data         = Company::find($id);
        
    //     $this->id         = $this->data->id;
    // }


    public $data;
    public $region_id;
    public $name;
    protected $listeners = ['company-delete' => 'companyDelete'];
    public function render()
    {
        return view('livewire.company.delete');
    }
    public function companyDelete($id)
    {
        $this->region_id = $id;
    }
    public function delete()
    {
        \App\Models\Company::find($this->id)->delete();
        $this->companydel('company-delete-hide');
        $this->reset();
    }

}
