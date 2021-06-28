<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ModuleGroup;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    
    public $data,$status,$client_project_id,$department_id;
    public $name;
    public $prefix_link,$icon,$color;
    public $items;
    public $parent_id,$name_group;
    protected $listeners = ['toggleModal','refresh-page'=>'refresh_page'];
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
    
    public function render()
    {
        return view('livewire.module.edit')->with(['data'=>$this->data]);
    }
    
    public function refresh_page()
    {
        return redirect()->route('module.edit',$this->data->id);
    }

    public function mount($id)
    {
        $this->data = \App\Models\Module::find($id);
        $this->items = \App\Models\ModulesItem::where('module_id',$id)->whereNull('parent_id')->get();
        $this->name = $this->data->name;
        // $this->icon = $this->data->icon;
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
            // 'icon'=>'required'
        ]);   
        $this->data->name = $this->name;
        $this->data->prefix_link = $this->prefix_link;
        // $this->data->icon = $this->icon;
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
        $this->parent_id = $id;
        $this->emit('modalAddFunction',$id);
    }

    public function toggleModal()
    {
        $this->items = $this->items->fresh();
        $this->items = \App\Models\ModulesItem::where('module_id',$this->data->id)->get();
        
        $this->emit('hideModal');
    }
}
