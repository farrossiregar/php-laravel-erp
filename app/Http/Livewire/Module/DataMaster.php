<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModuleGroup;
use Livewire\WithFileUploads;
use App\Models\Module;
use App\Models\ModulesItem;

class DataMaster extends Component
{
    use WithFileUploads;
    
    public $data,$status,$client_project_id,$department_id;
    public $name;
    public $prefix_link,$icon,$color;
    public $items;
    public $parent_id,$name_group;
    protected $listeners = ['toggleModal','refresh-page'=>'refresh_page'];
    protected $paginationTheme = 'bootstrap';
    
    public $name_function,$link_function,$parent_id_function;

    use WithPagination;
    
    public function render()
    {
        return view('livewire.module.data-master');
    }
    
    public function refresh_page()
    {
        return redirect()->route('module.data-master',$this->data->id);
    }

    public function mount($id)
    {
        $this->data = Module::find($id);
        $this->items = ModulesItem::where('module_id',$id)->whereNull('parent_id')->get();
        $this->name = $this->data->name;
        $this->prefix_link = $this->data->prefix_link;
        $this->color = $this->data->color;
        $this->status = $this->data->status;
        $this->department_id = $this->data->department_id;
        $this->client_project_id = $this->data->client_project_id;
    }
    
    public function save_group()
    {
        $this->validate([
            'name_group'=>'required'
        ]);
        $new = new ModuleGroup();
        $new->name = $this->name_group;
        $new->module_id = $this->data->id;
        $new->save();

        $this->emit('refresh-page');
    }

    public function save()
    {
        $this->validate([
            'name'=>'required',
        ]);   
        $this->data->name = $this->name;
        $this->data->prefix_link = $this->prefix_link;
        $this->data->color = $this->color;
        $this->data->status = $this->status;
        
        if($this->icon){
            $name = date('Ymdhis') .".".$this->icon->extension();
            $this->icon->storeAs("public/department/{$this->data->id}", $name);
            $this->data->icon = "storage/department/{$this->data->id}/{$name}";
        }

        $this->data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.index');
    }
    
    public function deleteItem($id)
    {
        \App\Models\ModulesItem::find($id)->delete();
        $user_access = \App\Models\UserAccessModule::where('module_id')->first();
        if($user_access) $user_access->delete();
        
        $this->items = $this->items->fresh();
        $this->items = \App\Models\ModulesItem::where('module_id',$this->data->id)->get();
    }

    public function addFunction($id)
    {
        $this->parent_id_function = $id;
        $this->emit('modalAddFunction',$id);
    }

    public function toggleModal()
    {
        $this->items = $this->items->fresh();
        $this->items = \App\Models\ModulesItem::where('module_id',$this->data->id)->get();
        
        $this->emit('hideModal');
    }

    public function save_function()
    {
        $this->validate([
            'name_function'=>'required',
            'link_function'=>'required'
        ]);

        $data = new \App\Models\ModulesItem();
        $data->module_id = $this->data->id;
        $data->name = $this->name_function;
        $data->link = $this->link_function;
        $data->type = 2;
        $data->parent_id = $this->parent_id_function;
        $data->status = 1;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.index');
    }
}
