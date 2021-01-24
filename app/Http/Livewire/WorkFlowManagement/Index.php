<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        if(!check_access('work-flow-management.index')){
            session()->flash('error-message','Access denied !');
            $this->redirect('/');
        }
        $data = \App\Models\WorkFlowManagement::orderBy('updated_at','DESC');
        return view('livewire.work-flow-management.index')->with(['data'=>$data->paginate(100)]);
    }

}
