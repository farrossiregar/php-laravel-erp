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
    public $keyword,$company_id,$name_data_master,$status_data_master;
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

    public function save_data_master()
    {
        $this->validate([
            'name_data_master' => 'required'
        ]);

        $insert = new ModulesItem();
        $insert->module_id = 17;
        $insert->type = 1;
        $insert->name = $this->name_data_master;
        $insert->is_show = 0;
        $insert->save();
    }
}
