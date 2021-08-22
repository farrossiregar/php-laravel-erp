<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\ModulesItem;

class Index extends Component
{   
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $keyword,$company_id;
    public function render()
    {
        $data = Module::orderBy('id','DESC')->groupBy('department_id');
        
        if($data) $data = $data->where("name","LIKE","%{$this->keyword}%");

        return view('livewire.module.index')->with(['data'=>$data->paginate(100)]);
    }

    public function delete($id)
    {
        ModulesItem::where('module_id',$id)->delete();
        Module::find($id)->delete();
    }
}
