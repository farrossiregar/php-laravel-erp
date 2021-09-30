<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Department;

class Index extends Component
{   
    public $non_projects=[],$projects=[],$department_icon_project,$department_name_project;
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emitEditHide'=>'$refresh','emitEditSubDepartmentHide'=>'$refresh'];
    public function render()
    {
        return view('livewire.department.index');
    }

    public function mount()
    {
        $this->projects = Department::where('is_project',1)->get();
        $this->non_projects = Department::where('is_project',0)->get();
    }
    
    public function deleteSub($id)
    {
        $count = \App\Models\Employee::where('department_sub_id',$id)->count();
        if($count>0){
            //session()->flash('message-error',__('Delete data error'));
            //return redirect()->to('department');    
        }
        
        \App\Models\DepartmentSub::find($id)->delete();
        session()->flash('message-success',__('Data delete successfully'));
    }

    public function delete($id)
    {
        $count = \App\Models\Employee::where('department_id',$id)->count();
        if($count>0){
            session()->flash('message-error',__('Delete data error'));
            return redirect()->to('department');    
        }
        \App\Models\Department::find($id)->delete();
        session()->flash('message-success',__('Data delete successfully'));

        return redirect()->to('department');
    }

    public function save_project()
    {
        $this->validate([
            'department_name_project'=>'required'
        ]);
        $data = new Department();
        $data->name = $this->department_name_project;
        $data->is_project = 1;
        $data->save();
        
        if($this->department_icon_project){
            $name = date('Ymdhis') .".".$this->department_icon_project->extension();
            $this->department_icon_project->storeAs("public/module/{$data->id}", $name);
            $data->icon = "storage/module/{$data->id}/{$name}";
        }
        
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('department');
    }
}
