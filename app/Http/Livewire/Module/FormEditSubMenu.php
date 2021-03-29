<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;

use App\Models\ModulesItem;

class FormEditSubMenu extends Component
{
    public $data,$name,$link,$client_project_id;

    public function render()
    {
        return view('livewire.module.form-edit-sub-menu');
    }

    public function mount(ModulesItem $data)
    {
        $this->data = $data;
        $this->name = $data->name;
        $this->link = $data->link;
        $this->client_project_id = $data->client_project_id;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'link' => 'required',
            'client_project_id' => 'required'
        ]);

        $this->data->name = $this->name;
        $this->data->link = $this->link;
        $this->data->client_project_id = $this->client_project_id;
        $this->data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.edit',['id'=>$this->data->module_id]);
    }
}
