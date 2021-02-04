<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;

class Edit extends Component
{
    public $data;
    public $name;
    public $prefix_link,$icon;
    public $items;
    public $parent_id;
    protected $listeners = ['toggleModal'];
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
    
    public function render()
    {
        return view('livewire.module.edit')->with(['data'=>$this->data]);
    }
    
    public function mount($id)
    {
        $this->data = \App\Models\Module::find($id);
        $this->items = \App\Models\ModulesItem::where('module_id',$id)->whereNull('parent_id')->get();
        $this->name = $this->data->name;
        $this->icon = $this->data->icon;
        $this->prefix_link = $this->data->prefix_link;
    }
    public function save()
    {
        $this->validate([
            'name'=>'required',
            'icon'=>'required'
        ]);   
        $this->data->name = $this->name;
        $this->data->prefix_link = $this->prefix_link;
        $this->data->icon = $this->icon;
        $this->data->save();
        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.edit',['id'=>$this->data->id]);
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
