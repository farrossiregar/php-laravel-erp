<?php

namespace App\Http\Livewire\UserAccess;

use Livewire\Component;
use App\Models\UserAccess;

class Index extends Component
{
    protected $listeners = ['refresh-page'=>'$refresh'];
    public $non_projects=[],$projects=[],$name_project,$description_project;
    public function render()
    {
        return view('livewire.user-access.index');
    }

    public function mount()
    {
        $this->non_projects = UserAccess::where('is_project',0)->get();
        $this->projects = UserAccess::where('is_project',1)->get();
    }

    public function delete($id)
    {
        UserAccess::find($id)->delete();
    }

    public function save_project()
    {
        $this->validate([
            'name_project' => 'required',
        ]);
        
        $access = new UserAccess();
        $access->name = $this->name_project;
        $access->description = $this->description_project;
        $access->is_project  = 1;
        $access->save();

        $this->projects = UserAccess::where('is_project',1)->get();
        $this->reset(['name_project','description_project']);
    }
}
