<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{   
    public $data;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emitEditHide'=>'$refresh','emitEditSubDepartmentHide'=>'$refresh'];
    public function render()
    {
        return view('livewire.department.index');
    }
    public function mount()
    {
        $this->data = \App\Models\Department::orderBy('name','ASC')->get();
    }
    public function deleteSub($id)
    {
        $count = \App\Models\Employee::where('department_sub_id',$id)->count();
        if($count>0){
            session()->flash('message-error',__('Delete data error'));
            return redirect()->to('users');    
        }
        \App\Models\DepartmentSub::find($id)->delete();
        session()->flash('message-success',__('Data delete successfully'));

        return redirect()->to('department');
    }
    public function delete($id)
    {
        $count = \App\Models\Employee::where('department_id',$id)->count();
        if($count>0){
            session()->flash('message-error',__('Delete data error'));
            return redirect()->to('users');    
        }
        \App\Models\Department::find($id)->delete();
        session()->flash('message-success',__('Data delete successfully'));

        return redirect()->to('department');
    }
}
